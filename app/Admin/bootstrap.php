<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
use App\Admin\Extensions\MediaField;
use App\Admin\Extensions\TranslatableTextarea;

Admin::js('/assets/js/admin.js');
Admin::css('/assets/css/admin.css');
// Admin::js('/vendor/chartjs/dist/chart.js');

Encore\Admin\Form::forget(['map', 'editor']);
Encore\Admin\Form::extend('mediaField', MediaField::class);
Encore\Admin\Form::extend('translatableTextarea', TranslatableTextarea::class);

