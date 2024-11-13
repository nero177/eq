<?php

namespace App\Admin\Controllers;

use App\Enums\ArticleType;
use App\Models\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ArticlesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Blog';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());
        $currLocale = LaravelLocalization::getCurrentLocale();

        $grid->column('id', __('Id'));
        $grid->column('title->'.$currLocale, __('Title'));
        $grid->column('short_desc->'.$currLocale, __('Short description'));
        $grid->column('is_popular', __('Is popular'));
        $grid->column('order', __('Order'));

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
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('is_popular', __('Is popular'));
        $show->field('order', __('Order'));
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
        $form = new Form(new Article());
        $currLocale = LaravelLocalization::getCurrentLocale();
        $articles = Article::get()->pluck('title', 'id');

        $form->submitted(function (Form $form) {
            $form->ignore('thumbnail');
            $form->ignore('main_image');
        });

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $required = $lang == $currLocale ? 'required' : 'nullable';
            $form->text('title.' . $lang, 'Title ' . $langData['native'])->rules("max:200");
            $form->text('short_desc.' . $lang, 'Short description ' . $langData['native'])->rules("max:200");
            $form->summernote('content.' . $lang, 'Content ' . $langData['native'])->rules("{$required}");
        }

        $form->mediaField('thumbnail', __('Thumbnail'));
        $form->mediaField('main_image', __('Main image'));
        $form->radio('type', __('Type'))->options(ArticleType::casesWithAliases())->default(ArticleType::DEFAULT->value);
        $form->number('order', __('Order'))->default(1);
        $form->multipleSelect('related', __('Related articles'))->options($articles);

        return $form;
    }
}
