<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use MetroMarket\MobilePanel\Models\Post;
use MetroMarket\MobilePanel\Models\SlideModel;

class SliderController extends Controller
{
    protected $attachmentPath;
    protected $photoVersions;
    protected $type;
    protected $options;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'SlidePhoto';
        $this->attachmentPath = base_path().'/public/upload/slides/';
        $this->photoVersions = array(
            '' => array(
                'auto_orient' => false,
            ),
            'large' => array(
                'upload_dir' => $this->attachmentPath.'600/',
                'max_width' => 600,
                'max_height' => 400,
            ),
            'medium' => array(
                'upload_dir' => $this->attachmentPath.'400/',
                'max_width' => 400,
                'max_height' => 220,
                'crop' => true,
            ),
            'small' => array(
                'upload_dir' => $this->attachmentPath.'100/',
                'max_width' => 100,
                'max_height' => 50,
            ),
        );
        $this->options = array(
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
        $per_page = $request->get('limit', Post::PER_PAGE);
        $posts = SlideModel::key($this->type)->valid()->orderBy('created_at', 'desc');
        if ($request->ajax() || $request->wantsJson()) {
            $posts = $posts->paginate($per_page);
            $not_active_ids = SlideModel::key($this->type)->withTrashed()->notValid()->get(['id']);
            $not_active_ids = $not_active_ids->each(function ($item, $key) {
                $item->setAppends([]);
            });
            $posts = json_decode($posts->tojson());
            $posts->not_active_ids = $not_active_ids;

            return response()->json($posts, 200);
        }
        $posts = $posts->paginate($per_page);

        return view('panel.slider.index')->with(['posts' => $posts]);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file($this->options['param_name']);
        $extension = $file->getClientOriginalExtension();
        $this->options['filename'] = uniq_name().'.'.$extension;
        $uploadFile = $this->upload_file($this->options);
        $object = new Post();
        $object->value = json_encode(['image_name' => $this->options['filename'], 'title' => $request->get('title')]);
        $object->type = $this->type;
        $object->save();

        return $uploadFile;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $posts = SlideModel::key($this->type)->valid()->where('id', $id)->firstOrFail();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(array(
                'data' => $posts,
            ), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('file');

        $post = Post::where(array(
            'type' => $this->type,
            'id' => $id,
        ))->firstOrFail();

        $post_content = json_decode($post->value);

        $old_photo = '';

        if ($request->hasFile('file')) {
            if (isset($post_content->image_name)) {
                $old_photo = $post_content->image_name;
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $this->options['filename'] = uniq_name().'.'.$extension;
            $uploadFile = $this->upload_file($this->options);
            $data['image_name'] = $this->options['filename'];
        } else {
            $data['image_name'] = $post_content->image_name;
        }

        $post->value = json_encode($data);
        $post->save();

        if ($request->hasFile('file')) {
            if ($old_photo != $this->options['filename']) {
                $old_photo_path = $this->attachmentPath.$old_photo;

                if (File::exists($old_photo_path)) {
                    File::delete($old_photo_path);
                }
            }
        }

        return response()->json(array(
            'success' => true,
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Post::find($id);

        $post_content = json_decode($slide->value);
        $old_photo = $post_content->image_name;
        $old_photo_path = $this->attachmentPath.$old_photo;

        $slide->delete();

        if (File::exists($old_photo_path)) {
            File::delete($old_photo_path);
        }

        return response()->json(array(
            'success' => true,
        ));
    }
}
