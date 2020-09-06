<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //protected $fillable = ['name', 'slug', 'price'];
    /**
     * @var mixed
     */
    public $name;
    public $slug;
    public $price;
    public $description;

}
