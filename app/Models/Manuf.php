<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Manuf extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name"];
    

    public function posts(){
        return $this->belongsToMany(Post::class, "manuf_posts");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    

    
}