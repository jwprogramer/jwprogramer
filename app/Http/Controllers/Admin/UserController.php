<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
        
    public function list(Request $request){
        $pagination = User::orderBy("name");
        
       
        return view("admin.users.index", ["list"=>$pagination->paginate(3)]);
    }

    public function store(UserRequest $request){

        $data = $request->all();
     
        $user = User::create($data);
        return redirect(route("users.edit", $user))->with("success",__("Data saved!"));
    }

    public function edit(User $user){


        $posts = Post::where("user_id",$user->id)->paginate(5);
        $list = User::all();

        return view("admin.users.form",["data"=>$user, 
                                        "posts"=>$posts,
                                        "list" =>$list]);
    }

    public function update(User $user, UserRequest $request) {
        $data = $request->level;
        
        $user->update($data);

        
        return redirect(route("home"))->with("success",__("Data updated!"));
    }

}
