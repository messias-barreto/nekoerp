<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = [
        'quantidade',
        'produto_id'
    ];
}
