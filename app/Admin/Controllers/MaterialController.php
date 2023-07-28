<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\MaterialForm;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Material;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Table;
use Illuminate\Http\Request;

class MaterialController extends AdminController
{
    protected $title = 'Material';
    public static function table(){
        $table = new Table(new Material());
        $table->column('id', 'ID')->sortable();
        $table->column('barcode', '条码')->sortable()->searchable();
        $table->column('name', '名称')->sortable()->searchable();
        $table->column('description', '描述');
        $table->column('style', '格式');
        $table->column('color', '颜色');
        $table->column('price', '价格');
        $table->column('weight', '重量（KG）');
        $table->column('length', '长');
        $table->column('width', '宽');
        $table->column('height', '高');
        $table->column('created_at', '创建时间')->searchable();
        $table->filter(function(Table\Filter $filter){
            $filter->column(1/2,function($filter){
                $filter->like('barcode', '条码');
                $filter->like('name', '名称');
            });
            $filter->column(1/2,function($filter){
                $filter->between('created_at', '创建时间')->datetime();
            });

        });
        return $table;
    }
    public function index(Content $content)
    {

        $table = self::table();
        return $content
            ->title('物料管理')
            //->description('')
            ->row("物料管理")
            ->body($table);
    }

    public function create(Content $content)
    {
            $content
              ->title($this->title())
              ->description($this->description['create'] ?? trans('admin.create'));
              //->body(new MaterialForm());

        return $this->renderModalForm($this->form()->create(), $content);
    }

    /**
     * @return MaterialForm|Form
     */
    public function form(){
        $form = new Form(new Material());
        $form->row(function(Form\Layout\Row $row){
            $row->column(6,function(Form\Layout\Column $column){
                $column->text('name')->rules('required');
                $column->text('code')->rules('required');
                $column->text('barcode')->rules('required');
                $column->text('description')->rules('required');
                $column->text('style');
                $column->text('color');
            });
            $row->column(6,function(Form\Layout\Column $column){
                $column->text('length');
                $column->text('width');
                $column->text('height');
                $column->text('weight');
                $column->text('price');
            });
        });
        /** @var Form $form */
        return $form;
    }
    public function store()
    {
        //dd($this->form()->create());
        return $this->form()->create()->store();
    }
}
