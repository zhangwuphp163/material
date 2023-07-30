<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Outbound extends Model implements Auditable
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    protected $table = 'outbounds';
    protected $fillable = [
        'outbound_number',
        'status',
        'remark',
        'ata_at',
        'time_consuming',
        'processing_costs',
        'freight',
        'outbound_at'
    ];

    public function items(){
        return $this->hasMany(OutboundItem::class);
    }
}
