<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @property int status
 * @property mixed inbound_at
 * @property mixed confirmed_at
 * @property  InboundItem items
 */
class Inbound extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use DefaultDatetimeFormat;
    use \OwenIt\Auditing\Auditable;

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $table = 'inbounds';
    protected $fillable = [
        'inbound_number',
        'ata_at',
        'inbound_at',
        'confirmed_at',
        'remark'
    ];

    public function items(){
        return $this->hasMany(InboundItem::class);
    }
}
