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

        return $this->renderModalForm($this->form()->create(), $content);
    }

    /**
     * @return MaterialForm|Form
     */
    public function form(){
        $form = new Form(new Material());
        $form->tab("基本信息",function($form){
            $form->text('name','名称')->rules('required');
            $form->text('barcode','条码')->rules('required');
            $form->text('description','描述')->rules('required');
        });
        $form->tab("其他信息",function($form){
            /** @var \Encore\Admin\Widgets\Form $form */
            $form->text('style','格式');
            $form->text('color','颜色');
            $form->decimal('length','长(cm)');
            $form->decimal('width','宽(cm)');
            $form->decimal('height','高(cm)');
            $form->decimal('weight','重量(g)');
            $form->decimal('price','价格');
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
