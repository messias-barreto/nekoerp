<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoType extends Model
{
    protected $fillable = [
        'name', 
        'value'
    ];
}
