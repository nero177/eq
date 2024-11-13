<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Collection;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());
        $currLocale = LaravelLocalization::getCurrentLocale();

        $grid->column('id', __('Id'));
        $grid->column('title->' . $currLocale, __('Title'));
        $grid->column('desc->' . $currLocale, __('Desc'));
        $grid->column('order', __('Order'));
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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('desc', __('Desc'));
        $show->field('order', __('Order'));
        $show->field('link', __('Link'));
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

        $form = new Form(new Banner());
        $currLocale = LaravelLocalization::getCurrentLocale();

        $form->submitted(function (Form $form) {
            $form->ignore('bg');
            $form->ignore('bg_mob');
        });

        // $editable = $form->model()->first();
        foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
            $form->text('title.' . $lang, 'Title ' . $langData['native'])->rules("max:200");
        }

        $form->translatableTextarea('desc', 'Description');

        $form->number('order', __('Order'))->default(1);
        $form->multipleSelect('show_in', __('Show place'))->options(['main' => 'Main', 'master_classes' => 'Master classes'])->rules('required');
        $form->url('video_link', __('Video url'));
        $form->file('bg', __('Background'))->removable();
        $form->file('bg_mob', __('Background mobile'))->removable();

        $form->embeds('buttons', __('Buttons'), function ($form) {
            $form->embeds('button1', function ($form) {
                $form->radio('show', __('Show'))->options([0 => 'No', 1 => 'Yes']);
                $form->select('type')->options(['video_popup' => 'Video popup', 'link' => 'Link', 'collection' => 'Buy course'])->rules('required');

                foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                    $form->text('button_text_' . $lang, 'Button text ' . $langData['native']);
                }

                $form->text('video_url', __('Video url (if video popup)'));

                foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                    $form->text('link_' . $lang, __('Link (if just a link) ' . $langData['native']));
                }

                $form->radio('is_external', __('Is external'))->options([0 => 'No', 1 => 'Yes']);
            });

            $form->embeds('button2', function ($form) {
                $form->radio('show', __('Show'))->options([0 => 'No', 1 => 'Yes']);
                $form->select('type')->options(['video_popup' => 'Video popup', 'link' => 'Link', 'collection' => 'Buy course'])->rules('required');

                foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                    $form->text('button_text_' . $lang, 'Button text ' . $langData['native']);
                }

                $form->text('video_url', __('Video url (if video popup)'));

                foreach (LaravelLocalization::getLocalesOrder() as $lang => $langData) {
                    $form->text('link_' . $lang, __('Link (if just a link) ' . $langData['native']));
                }
                
                $form->radio('is_external', __('Is external'))->options([0 => 'No', 1 => 'Yes']);
            });
        });

        $collections = Collection::get()->pluck('title', 'id');

        $form->embeds('details', __('Course/Collection banner setings'), function ($form) use ($collections) {
            $form->text('price', __('Price'));
            $form->text('discount', __('Discount'));
            $form->multipleSelect('show_on_locales', __('Language versions to show'))->options(['uk' => 'Ukrainian', 'ru' => 'Russian', 'en' => 'English'])->rules('required');
            $form->radio('is_collection_banner')->options([0 => 'No', 1 => 'Yes'])->rules('required');
            $form->select('collection_id', __('Collection'))->options($collections);
        });

        return $form;
    }
}
