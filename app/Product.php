<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'image','price','type'
    ];



    public function getPriceAttribute($value){
        $newForm = "$".$value;
        return $newForm;

    }
}
