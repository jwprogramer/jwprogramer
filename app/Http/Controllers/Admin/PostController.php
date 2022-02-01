<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
        
    public function list(Request $request){
        $pagination = Post::orderBy("cont");

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

        return view("admin.posts.index", ["list"=>$pagination->paginate(3)]);
    }

    public function create(){
        return view("admin.posts.form", ["data"=>new Post()] );
    }

    public function store(PostRequest $request){
        $validated = $request->validated();

        $path = $request->file('image')->store('posts',"public");

        $data = $request->all();
        $data["image"] = $path;
        $data["user_id"] = Auth::user()->id;

        $post = Post::create($data);
        return redirect(route("post.edit", $post))->with("success",__("Data saved!"));
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success",__("Data deleted!"));
    }


    #abre o formulario de edição
    public function edit(Post $post){
        return view("admin.posts.form",["data"=>$post]);
    }

    #salva as edições
    public function update(Post $post, PostRequest $request) {
        $validated = $request->validated();

        $data = $request->all();
        #necessário, pois não é obrigatório atualizar a imagem
        if ($request->file('image') != null){
            $path = $request->file('image')->store('posts',"public");
            $data["image"] = $path;
        }

        $post->update($data);
        return redirect()->back()->with("success",__("Data updated!"));
    }

    

}
