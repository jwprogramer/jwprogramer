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
    

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    

    
}
