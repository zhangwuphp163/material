<?php

namespace App\Admin\Forms;

use App\Models\Client;
use Encore\Admin\Form\Layout\Column;
use Encore\Admin\Form\Layout\Row;
use Encore\Admin\Table;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialForm extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'Materials';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return $this
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        return $this->success('Processed successfully.');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->row(function(Row $row){
            $row->column(6,function(Column $column){
                $column->text('name')->rules('required');
                $column->text('code')->rules('required');
                $column->text('barcode')->rules('required');
                $column->select('client_id')->options(Client::pluck('name','id')->toArray())->placeholder("请选择客户");
                $column->text('description');
                $column->text('style');
                $column->text('color');
            });
            $row->column(6,function(Column $column){
                $column->text('length');
                $column->text('width');
                $column->text('height');
                $column->text('weight');
                $column->text('price');
            });
        });
        //$this->tools(function(Table\Tools $tools){
            /*$tools->disableList();

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();*/
        //});

        //$this->disableReset();
        /*$this->footer(function ($footer) {

            // 去掉`重置`按钮
            $footer->disableReset();

            // 去掉`提交`按钮
            $footer->disableSubmit();

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });*/

        /*$this->tools(function(Table\Tools $tools){
            $tools->disableList();

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();
        });*/
        //$this->confirm()
    }

}
