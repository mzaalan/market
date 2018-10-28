<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use MetroMarket\MobilePanel\Http\Requests\verifyNotificationRequest;
use MetroMarket\MobilePanel\Jobs\SendPushNotifications;
use MetroMarket\MobilePanel\Models\NotificationModel;
use MetroMarket\MobilePanel\Models\Post;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $type;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'Notification';
    }

    public function index(Request $request)
    {
        $per_page = $request->get('limit', Post::PER_PAGE);
        $posts = NotificationModel::key('Notification')->valid()->latest();
        if ($request->ajax() || $request->wantsJson()) {
            $posts = $posts->paginate($per_page);
            $not_active_ids = NotificationModel::key('Notification')->withTrashed()->notValid()->get(['id']);
            $not_active_ids = $not_active_ids->each(function ($item, $key) {
                $item->setAppends([]);
            });
            $posts = json_decode($posts->tojson());
            $posts->not_active_ids = $not_active_ids;

            return response()->json($posts, 200);
        }
        $posts = $posts->paginate($per_page);

        return view('panel.notifications.index')->with('posts', $posts);
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
    public function store(verifyNotificationRequest $request)
    {
        $data = $request->only(array_keys($request->rules()));
        $data['value'] = json_encode($data);
        $data['type'] = $this->type;
        $post = Post::create($data);
        $post = $post->fresh();

        $this->dispatch(new SendPushNotifications([
            'id' => $post->id,
            'message' => $data['message'],
        ]));

        return response()->json(array(
            'success' => true,
        ));
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
        $posts = NotificationModel::key('Notification')->valid()->where('id', $id)->firstOrFail();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(verifyNotificationRequest $request, $id)
    {
        $data = $request->only(array_keys($request->rules()));
        $data['value'] = json_encode($data);
        $notification = Post::find($id);
        $notification->update($data);

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
        $notification = Post::find($id);
        $notification->delete();

        return response()->json(array(
            'success' => true,
        ));
    }
}
