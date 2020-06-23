<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ImgVideos;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ImgVideosController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ImgVideos(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->user_id;
            $grid->type;
            $grid->url;
            $grid->is_show;
            $grid->view_count;
            $grid->zan_count;
            $grid->created_at;
            $grid->updated_at->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

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
        return Show::make($id, new ImgVideos(), function (Show $show) {
            $show->id;
            $show->user_id;
            $show->type;
            $show->url;
            $show->is_show;
            $show->view_count;
            $show->zan_count;
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
        return Form::make(new ImgVideos(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('type');
            $form->text('url');
            $form->text('is_show');
            $form->text('view_count');
            $form->text('zan_count');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
