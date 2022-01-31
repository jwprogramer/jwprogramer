<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "cont",
        "address",
        "model",
        "manuf",        
        "rent_date",
        "image",
        "user_id"
    ];

    protected $dates = [
        "rent_date"
    ];
    
    #mutator
    /*public function setContAttribute($cont){
        #$this->attributes["cont"] = $cont;

        #if ($this->slug != "")
           # return;#evitar que seja alterado

        $post = Post::withTrashed()
                        ->orderByDesc("id")
                        ->firstWhere("model",Str::model($cont));
        $id = "";
        if ($post){
            $id = "_".($post->id + 1);
        }
    
        $this->attributes["model"] = Str::model($cont).$id;
    }*/

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    

    
}
