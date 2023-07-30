<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class SkuItem extends Model implements Auditable
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $table = 'sku_items';
    protected $fillable = [
        'sku_id',
        'material_id',
        'qty'
    ];

    public function sku(){
        return $this->belongsTo(Sku::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
