<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManufRequest;
use App\Models\Manuf;
use App\Models\Manuf_rents;
use App\Models\ManufPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ManufController extends Controller
{
        
    public function list(Request $request){
        $pagination = Manuf::orderBy("name");

        if (isset($request->busca) && $request->busca != "") {
            $pagination->orWhere("name","like","%$request->busca%");
        }

        return view("admin.manufs.index", ["list"=>$pagination->paginate(5)]);
    }

    public function create(){
        $manufsList = Manuf::all();
        return view("admin.manufs.form", ["data"=>new Manuf(),
                                          "manufsList"=>$manufsList] );
    }

    public function store(Request $request){
        
        $data = $request->all();
        $manuf = Manuf::create($data);

        return redirect(route("manufs.edit", $manuf))->with("success",__("Data saved!"));
    }

    public function destroy(Manuf $inf){
        $inf->delete();
        return redirect(route("manufs.list"))->with("success",__("Data deleted!"));
    }

    public function edit(Manuf $manuf){
        $manufsList = Manuf::all();

        $manufs = Manuf::select("manufs.*", "manuf_rents.id as manuf_rents_id")
               ->join("manuf_rents","manuf_rents.manuf_id","=","manufs.id")
               ->where("manuf_id",$manuf->id)->paginate(2);

        
        return view("admin.manufs.form",["data"=>$manuf,
                                         "manufsList"=>$manufsList,
                                         "manufs"=>$manufs
                                         ]);
    }

    public function update(Manuf $post, ManufRequest $request) {
        //Gate::authorize('update', $inf);
        $data = $request->all();
        $post->update($data);

        if ($request["manuf_id"]){
            $inf = Manuf::find($request["manuf_id"]);
            Manuf_rents::updateOrCreate(["post_id"=>$post->id,"manuf_id"=>$inf->id]);
        }

        return redirect()->back()->with("success",__("Data updated!"));
    }

}