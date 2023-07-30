<?php

namespace App\Admin\Actions\Post\Inbound;

use App\Models\InboundItem;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Layout\Row;
use Encore\Admin\Table;
use Illuminate\Database\Eloquent\Model;

class Confirm extends RowAction
{
    public $name = '确认入库';

    public function handle(Model $model)
    {
        // $model ...

        return $this->response()->success('Success message.')->refresh();
    }

    public function href()
    {
        //return '/admin/inbound/items/'.$this->getKey();
   }



    public function html()
    {
        return "<div>Debug</div>";
    }

}