<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use MetroMarket\MobilePanel\Http\Requests;
use MetroMarket\MobilePanel\Http\Controllers\Controller;
use MetroMarket\MobilePanel\Models\Post;

class PhotoController extends Controller
{
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$size)
    {
        try
        {
            $object = Post::find($id);
            $this->attachmentPath = base_path().'/public/upload/'.Post::getImageBasePath($object->type).'/';
            $image_name = data_get($object->data,'image_name');
            $path = $this->attachmentPath.$size.'/'.$image_name;
            $file = File::get($path);
            $fileName = $image_name.'.'.File::extension($path);
        }
        catch (Illuminate\Filesystem\FileNotFoundException $ex){
            $path = base_path().'/public/upload/'.$size.'/_default.jpg';
            $file = File::get($path);
            $fileName = '_default.'.File::extension($path);
        }

        $response = response()->make($file);
        $response->header('Content-Type', File::type($path));
        $response->header('Content-disposition', 'inline; filename="'.$fileName.'"');

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ids = $request->get('ids');
        $page = $request->get('page');
        $per_page = $request->get('per_page');
        $i = 1 + ($page-1) * $per_page;
        foreach($ids as $id):
            $post = Post::find($id);
            if($post):
                $post->order = $i++;
                $post->save();
            endif;
        endforeach;
        return response()->json(['success'=>true]);
    }
}
