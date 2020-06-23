<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UsersController extends AdminController
{
    protected $girl_levels = [1=>'明星',2=>'女神',3=>'校花',4=>'班花',5=>'素人'];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->model()->where('sex','Ms');
            $grid->id->sortable();
            $grid->idcard;
            $grid->name;
            $grid->avatar()->image( '',80,80);
            //$grid->password;
            //$grid->remember_token;
            //$grid->sex;
            $grid->girl_level->using($this->girl_levels, '未知');
            //$grid->info;
            $grid->tel;
            $grid->huobi_addr;
            $grid->local_addr;
            $grid->total_fee;

            $grid->created_at;
            //$grid->updated_at->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('idcard');

                $filter->like('name');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            $show->name;
            //$show->password;
            $show->remember_token;
            $show->sex;
            $show->girl_level;
            $show->info;
            $show->tel;
            $show->huobi_addr;
            $show->local_addr;
            $show->total_fee;
            $show->idcard;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('password');
            $form->text('remember_token');
            $form->text('sex');
            $form->text('girl_level');
            $form->text('info');
            $form->text('tel');
            $form->text('huobi_addr');
            $form->text('local_addr');
            $form->text('total_fee');
            $form->text('idcard');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
