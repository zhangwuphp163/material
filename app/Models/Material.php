<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = "materials";
    protected $fillable = [
        'code',
        'barcode',
        'client_id',
        'name',
        'description',
        'style',
        'color',
        'weight',
        'price',
        'length',
        'width',
        'height',
    ];
}
