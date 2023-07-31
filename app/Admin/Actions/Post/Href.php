<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Table;
use Illuminate\Database\Eloquent\Model;

class Href extends RowAction
{
    public $name = '确认入库';

    public $url = '';

    public function __construct(String $url)
    {
        $this->url = $url;
    }

    public function handle(Model $model)
    {
        // $model ...
        return $this->response()->success('Success message.')->refresh();
    }

    public function href()
    {
        return $this->url.$this->getKey();
   }

}