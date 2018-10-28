<?php
namespace MetroMarket\MobilePanel\Http\Controllers;

use Illuminate\Http\Request;

use MetroMarket\MobilePanel\Http\Requests;
use MetroMarket\MobilePanel\Models\User;
use MetroMarket\MobilePanel\Http\Requests\VerifyUserRequest;
use MetroMarket\MobilePanel\Models\Post;

class UserController extends Controller{


    public function index(Request $request){
        $per_page = $request->get('limit',Post::PER_PAGE);
        $users = User::paginate($per_page);
        return view('panel.user.users')
            ->with('users',$users);
    }

    public function store(Request $request)
    {
        $data = $request->only(['name','username','is_active','password','repassword']);
        $data['is_active'] = ($data['is_active'] == 'on')  ? 1 : 0 ;
        $data['password'] = bcrypt($data['password']);
        User::create($data);      
        return response()->json(array(
                'success' => true,
            ) , 200);
    }

    public function update(Request $request,$id){    	
    	$data = $request->only(['name','username','is_active','password','repassword']);
        $data['is_active'] = ($data['is_active'] == 'on')  ? 1 : 0 ;
    	$current = User::findOrFail($id);
        if(empty($data['password'])) unset($data['password']);
        if(isset($data['password']))$data['password'] = bcrypt($data['password']);
        unset($data['username']);
        $current->update($data);
        return response()->json(array(
            'success' => true
        ));
    }

    public function destroy($id){
    	$user = User::find($id);
        $user->is_active = ($user->is_active == 1) ? 0 : 1;
        $user->save();
        return response()->json(array(
                'success' => true
                ));
    }
} 