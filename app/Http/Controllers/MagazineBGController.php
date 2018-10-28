<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use MetroMarket\MobilePanel\Http\Requests;
use MetroMarket\MobilePanel\Http\Controllers\Controller;
use MetroMarket\MobilePanel\Models\Post;
use MetroMarket\MobilePanel\Models\MagazineBG;
use Illuminate\Support\Facades\File;

class MagazineBGController extends Controller
{
    protected $attachmentPath;
    protected $photoVersions;
    protected $type;
    protected $options;

    public function __construct(){
        parent::__construct();
        $this->type = 'MagazineBG';
        $this->attachmentPath = base_path().'/public/upload/';
        $this->photoVersions = array(
            '' => array(
                'auto_orient' => false
            ),
            'large' => array(
                'upload_dir' => $this->attachmentPath.'600/',
                'max_width' => 600,
                'max_height' => 400
            ),
            'medium' => array(
                'upload_dir' => $this->attachmentPath.'400/',
                'max_width' => 400,
                'max_height' => 220,
                'crop' => true
            ),
            'small' => array(
                'upload_dir' => $this->attachmentPath.'100/',
                'max_width' => 100,
                'max_height' => 50
            )
        );
        $this->options =  array(
            'upload_dir' => $this->attachmentPath,
            'param_name' => 'file',
            'image_file_types' => '/\.(jpe?g|png)$/i',
            'accept_file_types' => '/\.(jpe?g|png)$/i',
            'image_versions' => $this->photoVersions,
            );
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $bg = MagazineBG::key($this->type)->first();
        return view('panel.magazine.bg')->with('bg',$bg);
    }


    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id)
    {
        $data = $request->only('file');
        $post = Post::where(array(
            'type' => $this->type,
            'id' => $id
            ))->firstOrFail();

        $post_content = json_decode($post->value);
        $old_photo = '';

        if ($request->hasFile('file')) {

            if(isset($post_content->image_name)){
                $old_photo = $post_content->image_name;  
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $this->options['filename'] =  uniq_name() . '.' . $extension;
            $uploadFile =  $this->upload_file($this->options);
            $data['image_name'] = $this->options['filename'];
        }else{
            $data['image_name'] = $post_content->image_name;
        }

        $post->value = json_encode($data);
        $post->save();

        if ($request->hasFile('file')) {
            if ($old_photo != $this->options['filename']) {
                $old_photo_path = $this->attachmentPath . $old_photo;

                if (File::exists($old_photo_path)) {
                    File::delete($old_photo_path);
                }
            }
        }

        return response()->json(array(
            'success' => true
            ));
    }
}
