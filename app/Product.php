<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = [
      'name', 'category', 'price', 'discount', 'description', 'user_id'
    ];

}
