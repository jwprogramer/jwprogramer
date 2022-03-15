<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Manuf;
use App\Models\Manuf_rents;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
        
    public function list(Request $request){
        Gate::authorize('viewAny', Post::class);
        $pagination = Post::orderBy("cont");
        $manuf_rents = Manuf::all();

        if (isset($request->busca) && $request->busca != "") {
            $pagination->orWhere("cont","like","%$request->busca%");
            $pagination->orWhere("model","like","%$request->busca%");
        }

        if (isset($request->cont) && $request->cont != "")
            $pagination->where("cont","like","%$request->cont%");

        if (isset($request->model) && $request->model != "")
            $pagination->where("model","like","%$request->model%");

        if (isset($request->manuf) && $request->manuf != "")
            $pagination->where("manuf","like","%$request->manuf%");

        if (isset($request->rent_date) && $request->rent_date != "")
            $pagination->whereDate("rent_date",$request->rent_date);

        return view("admin.posts.index", ["list"=>$pagination->paginate(3), "manuf_rents"=>$manuf_rents]);
    }

    public function create(){
        Gate::authorize('create', Post::class);
        $manuf_rents = Manuf::all();
        return view("admin.posts.form", ["data"=>new Post(), "manuf_rents"=>$manuf_rents] );
    }

    public function store(PostRequest $request){
        Gate::authorize('create', Post::class);
        $validated = $request->validated();

        $path = $request->file('image')->store('posts',"public");

        $data = $request->all();
        $data["image"] = $path;
        $data["user_id"] = Auth::user()->id;

        $post = Post::create($data);
        return redirect(route("post.edit", $post))->with("success",__("Data saved!"));
    }

    public function destroy(Post $post){
        Gate::authorize('delete', $post);
        $post->delete();
        return redirect(route("post.list"))->with("success",__("Data deleted!"));
    }


    #abre o formulario de edição
    public function edit(Post $post){
        Gate::authorize('view', $post);
        $manuf_rents = Manuf::all();

        $infos = Manuf::select("manufs.*", "manuf_rents.id as manuf_rents_id")
        ->join("manuf_rents","manuf_rents.manuf_id","=","manufs.id")
        ->where("manufs_id",$post->id)->paginate(2);



        return view("admin.posts.form",["data"=>$post,"manuf_rents"=>$manuf_rents,
                                        "manufs"=>$infos]);
    }


    public function update(Post $post, PostRequest $request) {
        Gate::authorize('update', $post);
        $validated = $request->validated();

        $data = $request->all();
       
        if ($request->file('image') != null){
            $path = $request->file('image')->store('posts',"public");
            $data["image"] = $path;
        }

        $post->update($data);

        if ($request["manuf_id"]){
            $inf = Manuf::find($request["manuf_id"]);
            Manuf_rents::updateOrCreate(["post_id"=>$post->id,"manuf_id"=>$inf->id]);
        }
        return redirect()->back()->with("success",__("Data updated!"));
    }

    

}
