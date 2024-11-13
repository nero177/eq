<?php

namespace App\Admin\Controllers;

use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Page';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page());
        $currLocale = LaravelLocalization::getCurrentLocale();

        $grid->column('id', __('Id'));
        $grid->column('slug', __('Slug'));
        $grid->column('title->' . $currLocale, __('Slug'));
        $grid->column('template', __('Template'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(Page::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('slug', __('Slug'));
        $show->field('template', __('Template'));
        $show->field('metadata', __('Metadata'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Page());
        $currLocale = LaravelLocalization::getCurrentLocale();

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->text('slug', __('Slug'));
            $form->text('template', __('Template'));
          
            $form->tab($langData['native'], function ($form) use ($lang, $currLocale, $langData) {
                $required = $lang == $currLocale ? 'required' : 'nullable';
                $form->text('title.' . $lang, 'Title ' . $langData['native'])->rules("{$required}|string|max:200");
                // $form->embeds('metadata.' . $lang, 'Metadata ' . $langData['native'], function ($form) {
                //     $form->text('title');
                // });

                $form->summernote('content.' . $lang, 'Content ' . $langData['native']);
            });
        }

        return $form;
    }
}
