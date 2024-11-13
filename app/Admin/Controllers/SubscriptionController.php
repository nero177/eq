<?php

namespace App\Admin\Controllers;

use App\Models\Subscription;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Enums\LessonType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubscriptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Subscription';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subscription());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('price', __('Price'));
        // $grid->column('period', __('Period'));
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
        $show = new Show(Subscription::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('price', __('Price'));
        $show->field('period', __('Period'));
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
        $form = new Form(new Subscription());

        $form->submitted(function (Form $form) {
            $form->ignore('access');
        });

        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->text('title.' . $lang, 'Title ' . $langData['native']);
        }

        $form->number('price', __('Price'));
        $form->number('discount', __('Discount'));
        // $form->number('period', __('Period (Days)'));
        $form->multipleSelect('access', __('Access'))->options(LessonType::casesWithAliases())->default(LessonType::from('master_class')->value);

        // foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
        //     $form->summernote('desc.' . $lang, __('Description ' . $langData['native']));
        // }

        // $form->embeds('details', function ($form) {
        // $form->number('order')->rules('required');
        // $form->radio('show_in_block', __('Show in subscriptions block'))->options([0 => 'No', 1 => 'Yes'])->rules('required');

        // $form->radio('button_behaviour', 'Button behaviour')->options([0 => 'Leads to another page', 1 => 'Adds to cart'])->rules('required');
        // $form->text('url', 'Url if btn leads to another page');

        // foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
        //     $form->text('button_text_' . $lang, __('Button text ' . $langData['native']));
        // }
        // });

        return $form;
    }
}
