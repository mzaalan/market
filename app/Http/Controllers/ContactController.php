<?php

namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;
use MetroMarket\MobilePanel\Http\Requests\ValidateContactRequest;
use MetroMarket\MobilePanel\Models\Post;

class ContactController extends Controller
{
    protected $type;

    public function __construct()
    {
        parent::__construct();
        $this->type = 'MemberMessage';
    }
    public function index(Request $request)
    {
        $per_page = $request->get('limit', 20);
        $posts    = Post::key($this->type)->orderBy('created_at', 'desc')->paginate($per_page);
        return view('panel.contact.index')->with('posts', $posts);
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
    public function store(ValidateContactRequest $request)
    {
        $data          = $request->except('_token');
        $data['type']  = $this->type;
        $data['value'] = json_encode($data);
        Post::create($data);
        return response()->json(array(
            'status'         => 'success',
            'successMessage' => 'تم استقبال طلبك بنجاح, سيتم الرد عليكم في اقرب فرصة',
        ), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $contact            = Post::find($id);
        $contact->is_active = ($contact->is_active == 1) ? 0 : 1;
        $contact->save();
        return response()->json(array(
            'success' => true,
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Post::find($id);
        $contact->delete();
        return response()->json(array(
            'success' => true,
        ));
    }
}
