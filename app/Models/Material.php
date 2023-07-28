<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use SoftDeletes;
    protected $table = "materials";
    protected $fillable = [
        'barcode',
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
