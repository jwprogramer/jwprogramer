<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Manuf extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "manuf_id"];
    

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
    public function posts(){
        return $this->belongsToMany(Post::class, "manufs_posts");
    }
    
}