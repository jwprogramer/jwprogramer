<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manuf_rents extends Model {
    use HasFactory;

    protected $fillable = ['post_id','manuf_id'];
    
}