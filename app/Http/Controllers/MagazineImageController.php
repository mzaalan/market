<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;

use MetroMarket\MobilePanel\Http\Requests;
use MetroMarket\MobilePanel\Models\MagazineImagesModel;
use MetroMarket\MobilePanel\Models\Post;
use Illuminate\Support\Facades\File;

class MagazineImageController extends Controller
{
    protected $attachmentPath;
    protected $photoVersions;
    protected $type;

    public function __construct(){
        parent::__construct();
        $this->type = 'MagazinePhoto';
        $this->attachmentPath = base_path().'/public/upload/magazine/';
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
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $options =  array(
            'upload_dir' => $this->attachmentPath,
            'param_name' => 'file',
            'image_file_types' => '/\.(jpe?g|png)$/i',
            'accept_file_types' => '/\.(jpe?g|png)$/i',
            'image_versions' => $this->photoVersions,
            );
        $file = $request->file($options['param_name']);
        $extension = $file->getClientOriginalExtension();
        $options['filename'] =  uniq_name() . '.' . $extension;
        $uploadFile =  $this->upload_file($options);
        $object = new MagazineImagesModel();
        $object->value = json_encode(['image_name'=>$options['filename']]);
        $object->type  = $this->type;
        $object->parent_id = $request->get('parent_id');
        $object->save();
        $uploadFile['id'] = $object->id;
        $uploadFile['image_url'] = $object->image_url;
        return response()->json($uploadFile);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $post = MagazineImagesModel::key($this->type)->valid()->where('id',$id)->firstOrFail();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(array(
                'data' => $post,
            ) , 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $magazine_image = Post::find($id);

        $post_content = json_decode($magazine_image->value);
        $old_photo =  $post_content->image_name;  
        $old_photo_path = $this->attachmentPath . $old_photo;

        $magazine_image->delete();

        if (File::exists($old_photo_path)) {
            File::delete($old_photo_path);
        }

        return response()->json(array(
                'success' => true
                ));
    }
}
