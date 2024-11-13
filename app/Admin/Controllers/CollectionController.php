<?php

namespace App\Admin\Controllers;

use App\Models\Collection;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Lesson;
use App\Enums\LessonType;

class CollectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Collection';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Collection());
        $currLocale = LaravelLocalization::getCurrentLocale();

        $grid->column('id', __('Id'));
        $grid->column('title->' . $currLocale, __('Title'));
        $grid->column('desc->' . $currLocale, __('Desc'));
        $grid->column('price', __('Price'));
        $grid->column('slug', __('Slug'));
        // $grid->column('period', __('Period'));
        // $grid->column('details', __('Details'));
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
        $show = new Show(Collection::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('desc', __('Desc'));
        $show->field('price', __('Price'));
        $show->field('slug', __('Slug'));
        $show->field('period', __('Period'));
        $show->field('details', __('Details'));
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Collection());
        $currLocale = LaravelLocalization::getCurrentLocale();
        $lessons = Lesson::get()->pluck('title', 'id');

        $form->submitted(function (Form $form) {
            $form->ignore('thumbnail');
            $form->ignore('banner');
            $form->ignore('banner_mob');
            $form->ignore('lessons');
        });

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $required = $lang == $currLocale ? 'required' : 'nullable';
            $form->text('title.' . $lang, 'Title ' . $langData['native'])->rules("{$required}|string|max:200");
            $form->textarea('desc.' . $lang, 'Description ' . $langData['native'])->rules("max:2000");
        }

        $form->radio('type', __('Type'))->options(LessonType::casesWithAliases())->default(LessonType::MASTER_CLASS);
        $form->text('slug', __('Slug'));
        $form->mediaField('banner', __('Banner'));
        $form->mediaField('banner_mob', __('Banner mobile'));
        $form->mediaField('thumbnail', __('Thumbnail'));
        $form->number('price', __('Price'));
        $form->number('discount', __('Discount'));
        $form->multipleSelect('lessons', __('Lessons'))->options($lessons);
        $form->radio('unique_template', __('Unique template'))->options([0 => 'No', 1 => 'Yes']);

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->textarea('details.' . $lang, 'Details ' . $langData['native']);
        }

        $form->embeds('modal_details', 'Modal details', function ($form) {
            $form->radio('show_in_modal')->options([0 => 'No', 1 => 'Yes']);
            $form->number('order');
            $form->text('button_url', 'Button url');

            foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                // $form->summernote('desc_' . $lang, 'Description ' . $langData['native']);
                $form->text('button_text_' . $lang, 'Button text ' . $langData['native']);
                $form->text('modal_title_' . $lang, 'Modal title ' . $langData['native']);
            }
        });

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->summernote('modal_text.' . $lang, 'Modal text ' . $langData['native']);
        }

        return $form;
    }
}
