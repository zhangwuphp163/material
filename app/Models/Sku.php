<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \OwenIt\Auditing\Contracts\Auditable;

class Sku extends Model implements Auditable
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $table = 'skus';
    protected $fillable = [
        'barcode',
        'name',
        'description'
    ];

    public function items(){
        return $this->hasMany(SkuItem::class);
    }
}
