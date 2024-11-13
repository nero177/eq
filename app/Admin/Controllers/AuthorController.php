<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AuthorController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Authors';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('role', __('Role'));

        $grid->model()->where('role', User::ROLE_AUTHOR);

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('role', __('Role'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->radio('role', __('Role'))->options([User::ROLE_AUTHOR => 'author'])->default(User::ROLE_AUTHOR);

        $form->submitted(function (Form $form) {
            $form->ignore('photo');
            $form->ignore('avatar');
        });

        $form->mediaField('photo', __('Photo'));
        $form->mediaField('avatar', __('Avatar'));

        $form->embeds('details', function ($form) {
            $form->number('order')->rules('required');
            $form->text('slug')->rules('required');
            $form->radio('show_in_about', __('Show in about page'))->options([0 => 'No', 1 => 'Yes']);

            foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                $form->text('author_name_' . $lang);
                $form->text('author_surname_' . $lang);
                $form->text('author_role_' . $lang);
            }
        });

        $form->table('achievements', __('Achievements'), function ($table) use ($form) {
            foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                $table->text('col1_' . $lang);
            }

            foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                $table->text('col2_' . $lang);
            }
        });

        return $form;
    }
}
