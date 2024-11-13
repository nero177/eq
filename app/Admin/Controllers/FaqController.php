<?php

namespace App\Admin\Controllers;

use App\Models\Faq;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FaqController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Faq';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Faq());
        $currLocale = LaravelLocalization::getCurrentLocale();

        $grid->column('id', __('Id'));
        $grid->column('question->'.$currLocale, __('Question'));
        $grid->column('answer->'.$currLocale, __('Answer'));
        $grid->column('order', __('Order'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Faq::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('question', __('Question'));
        $show->field('answer', __('Answer'));
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
        $form = new Form(new Faq());
        $currLocale = LaravelLocalization::getCurrentLocale();
        
        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $required = $lang == $currLocale ? 'required' : 'nullable';
            $form->text('question.' . $lang, 'Question ' . $langData['native'])->rules("{$required}|string|max:200");
            $form->textarea('answer.' . $lang, 'Answer ' . $langData['native'])->rules("{$required}|string|max:2000");
        }

        $form->number('order', __('Order'));

        return $form;
    }
}
