<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Manuf;
use App\Models\Manuf_rents;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManufController extends Controller
{
        
    public function list(Request $request){
        $pagination = Manuf::orderBy("name");

        if (isset($request->busca) && $request->busca != "") {
            $pagination->orWhere("name","like","%$request->busca%");
        }

        return view("admin.manuf.index", ["list"=>$pagination->paginate(3)]);
    }

    public function create(){
        $postsList = Post::all();
        return view("admin.manuf.form", ["data"=>new Manuf(),
                                            "postsList"=>$postsList] );
    }

    public function validator(array $data){
        $rules = [
            'name' => 'required|max:500',
            'post_id' => 'exclude_if:post_id,null|exists:posts,id',
        ];

        return Validator::make($data, $rules)->validate();
    }

    public function store(Request $request){
        $validated = $this->validator($request->all());
        
        $cat = Manuf::create($validated);

        
        #vinculação com post
        $post = Post::find($request["post_id"]);
        Manuf_rents::updateOrCreate(["post_id"=>$post->id,"manuf_id"=>$cat->id]);
    

        return redirect(route("manuf.edit", $cat))->with("success",__("Data saved!"));
    }

    public function destroy(Manuf $inf){
        $inf->delete();
        return redirect(route("manuf.list"))->with("success",__("Data deleted!"));
    }

    public function desvincular(Manuf_rents $inf_rents){
        $inf_rents->delete();
        return redirect()->back()->with("success",__("Data deleted!"));
    }


    #abre o formulario de edição
    public function edit(Manuf $manuf){
        $postsList = Post::all();

        $manufs = Post::select("posts.*", "manuf_posts.id as manuf_posts_id")
                ->join("manuf_posts","manuf_posts.post_id","=","posts.id")
                ->where("manuf_id",$manuf->id)->paginate(2);
    
        
        return view("admin.category.form",["data"=>$manuf,
                                           "postsList"=>$postsList,
                                           "posts"=>$manufs
                                         ]);
    }

    #salva as edições
    public function update(Manuf $inf, Request $request) {
        $validated = $this->validator($request->all());
        $inf->update($validated);


        $post = Post::find($request["post_id"]);
        #na documentação consta esse método
        #funciona, mas não insere os timestamps
        #$category->posts()->attach($post);
        Manuf_rents::updateOrCreate(["post_id"=>$post->id,"manuf_id"=>$inf->id]);
    

        return redirect()->back()->with("success",__("Data updated!"));
    }

}