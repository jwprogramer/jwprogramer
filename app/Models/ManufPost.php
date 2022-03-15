<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufPost extends Model {
    use HasFactory;

    protected $fillable = ['name','post_id'];

}

