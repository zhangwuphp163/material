<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Material extends Model implements Auditable
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
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
