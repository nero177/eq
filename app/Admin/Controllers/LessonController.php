<?php

namespace App\Admin\Controllers;

use App\Models\Lesson;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\LessonType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LessonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lesson());

        $currLocale = LaravelLocalization::getCurrentLocale();

        $grid->column('id', __('Id'));
        $grid->column('title->' . $currLocale, __('Title'));
        $grid->column('desc->' . $currLocale, __('Desc'));
        $grid->column('price', __('Price'));
        $grid->column('type', __('Type'));
        $grid->column('author', __('Author'))->display(function ($author) {
            return $author['name'];
        });
        $grid->column('order', __('Order'));
        $grid->column('video_lang', __('Video lang'));
        $grid->column('is_new', __('Is new'));
        $grid->column('created_at', __('Created at'))->display(function ($created_at) {
            return date('d-m-Y', strtotime($created_at));
        });

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
        $show = new Show(Lesson::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('desc', __('Desc'));
        $show->field('type', __('Type'));
        $show->field('price', __('Price'));
        $show->field('author', __('Author'));
        $show->field('duration', __('Duration'));
        $show->field('order', __('Order'));
        $show->field('is_new', __('Is new'));
        $show->field('captions', __('Captions'));
        $show->field('video_lang', __('Video lang'));
        $show->field('steps', __('Steps'));
        $show->field('you_will_learn', __('You will learn'));
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
        $form = new Form(new Lesson());
        $authors = User::where('role', User::ROLE_AUTHOR)->pluck('name', 'id');

        $form->submitted(function (Form $form) {
            $form->ignore('thumbnail');
            $form->ignore('haircut_scheme');
        });

        // $form->text('video_url', 'Video Url');

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->text('title.' . $lang, 'Title ' . $langData['native'])->rules("max:200");
            $form->textarea('desc.' . $lang, 'Description ' . $langData['native'])->rules("max:2000");
            $form->text('video_url.' . $lang, 'Video Url ' . $langData['native']);
        }

        $form->radio('type', __('Type'))->options(LessonType::casesWithAliases())->default(LessonType::MASTER_CLASS);

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->text('video_bottom_url.' . $lang, 'Video Bottom Url ' . $langData['native']);
        }

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->text('captions.' . $lang, 'Captions ' . $langData['native']);
        }

        $form->mediaField('thumbnail', __('Thumbnail'));
        $form->select('author_id', __('Author'))->options($authors);
        $form->number('price', __('Price'));
        $form->number('discount', __('Discount'));
        $form->number('duration', __('Duration'));
        $form->number('order', __('Order'))->default(1);
        $form->text('demo_url', __('Demo url'));
        $form->radio('is_new', __('Is new'))->options([1 => 'yes', 0 => 'no'])->default(0);
        $form->radio('is_free', __('Is free'))->options([1 => 'yes', 0 => 'no'])->default(0);
        // $form->multipleSelect('video_lang', __('Video lang'))->options(['ukrainian' => 'Ukrainian', 'russian' => 'Russian', 'english' => 'English'])->default('ukrainian');
        $form->text('diagram', 'Diagram iframe url');

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->summernote('steps.' . $lang, 'Steps ' . $langData['native']);
            $form->summernote('you_will_learn.' . $lang, 'You will learn ' . $langData['native']);
        }

        $form->mediaField('haircut_scheme', __('Haircut scheme'));

        return $form;
    }
}
