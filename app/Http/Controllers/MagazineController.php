<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use MetroMarket\MobilePanel\Http\Requests\MagazineRequestValidation;
use MetroMarket\MobilePanel\Jobs\SendPushNotifications;
use MetroMarket\MobilePanel\Models\MagazineBG;
use MetroMarket\MobilePanel\Models\MagazineModel;
use MetroMarket\MobilePanel\Models\MagazinePhotoModel;
use MetroMarket\MobilePanel\Models\Post;

class MagazineController extends Controller
{
    protected $type;
    protected $attachmentPath;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'Magazine';
        $this->attachmentPath = base_path().'/public/upload/magazine/';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = MagazineModel::key($this->type)->orderBy('created_at', 'desc');
        if ($request->ajax() || $request->wantsJson()) {
            $posts = $posts->valid()->with('images')->has('images')->get();
            $not_active_ids = MagazineModel::key($this->type)->withTrashed()->notValid()->get(['id']);
            $not_active_ids = $not_active_ids->each(function ($item, $key) {
                $item->setAppends([]);
            });
            $magazineBG = MagazineBG::key('MagazineBG')->first();

            return response()->json(array(
                'magazine_bg' => data_get($magazineBG, 'url'),
                'data' => $posts,
                'not_active_ids' => $not_active_ids,
            ), 200);
        }
        $posts = $posts->with('images')->get();

        return view('panel.magazine.index')->with('posts', $posts);
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
    public function store(MagazineRequestValidation $request)
    {
        $data = $request->only('title');
        $data['value'] = json_encode($data);
        $data['type'] = $this->type;
        $data['is_active'] = 0;
        Post::create($data);

        return response()->json(array(
            'success' => true,
        ), 200);
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
        $per_page = $request->get('limit', Post::PER_PAGE);
        $post = MagazineModel::where('id', $id)->key($this->type)->firstOrFail();
        $images = MagazinePhotoModel::where('parent_id', $id)->key('MagazinePhoto')->valid()->orderBy('order');
        if ($request->ajax() || $request->wantsJson()) {
            $images = $images->paginate($per_page);

            return response()->json($images, 200);
        }
        $images = $images->paginate($per_page);

        return view('panel.magazine.show')->with('posts', $images)->with('magazine', $post);
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
        $post = Post::findOrFail($id);
        $data = $request->only('title');
        $data['value'] = json_encode($data);
        $data['type'] = $this->type;
        $post->update($data);

        return response()->json(array(
            'success' => true,
        ), 200);
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
        $Magazine = Post::with('children')->find($id);
        foreach ($Magazine->children as $magazine_image):
            $post_content = json_decode($magazine_image->value);
        $old_photo = $post_content->image_name;
        $old_photo_path = $this->attachmentPath.$old_photo;

        $magazine_image->delete();

        if (File::exists($old_photo_path)) {
            File::delete($old_photo_path);
        }
        endforeach;
        $Magazine->delete();

        return response()->json(array(
            'success' => true,
        ));
    }

    public function activate(Request $request, $id)
    {
        $post = MagazineModel::findOrFail($id);
        $images = $post->images->count();
        if ($images == 0 && $post->is_active == 0) {
            return response()->json(array(
                'status' => 'fail',
                'errorMessage' => 'خطأ في المدخلات',
                'errorDetails' => 'لا يمكن نشر المجله قبل اضافة صور لها',
            ), 422);
        }
        $post->is_active = ($post->is_active == 1) ? 0 : 1;
        $post->save();
        if ($post->is_active) {
            $this->dispatch(new SendPushNotifications([
                'id' => $post->id,
                'message' => $post->notification_message,
            ]));
        }

        return response()->json(array(
            'success' => true,
        ), 200);
    }
}
