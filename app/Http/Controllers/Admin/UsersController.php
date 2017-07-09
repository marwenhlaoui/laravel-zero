<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name"      => "required|min:5|max:20",
            "email"     => "required|unique:users|email|max:100",
            "password"  => "required|min:6|max:20|confirmed"
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->save();  
        $alert['class'] = "success";
        $alert['title'] = "Done";
        $alert['msg'] = "user $user->name created sussfully !";
        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {    
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            "name"      => "required|min:5|max:20",
            "email"     => ["required","email","max:100",Rule::unique('users')->ignore($user->id)],
            "password"  => "max:20|confirmed"
        ]); 

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->role = (!empty($request->role))?true:false; 
        $user->save();  
        $alert['class'] = "warning";
        $alert['title'] = "Warning";
        $alert['msg'] = "user $user->name updated sussfully !";
        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $alert['class'] = "success";
        $alert['title'] = "Done";
        $alert['msg'] = "user <b>$user->name</b> deleted! ";
        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.users.index');
    }
}
