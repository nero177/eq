<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Encore\Admin\Form\Field\MultipleSelect;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Services\Admin\OptionsService;
use App\Models\User;
use Encore\Admin\Form;
use App\Models\Option;

class OptionController extends Controller
{
    public function __construct(private OptionsService $optionsService) {}

    public function index(Content $content)
    {
        return $content
            ->title('Options')
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'Start section';

                    $keys = [
                        'start_section_subscription',
                        'start_section_desc'
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);
                    $subscriptions = Subscription::get()->pluck('title', 'id');

                    $options = [
                        'start_section_subscription' => ['type' => 'select', 'options' => $subscriptions, 'translatable' => false, 'label' => __('Start section subscription'), 'value' => $values['start_section_subscription'] ?? []],
                        'start_section_desc' => ['type' => 'text', 'translatable' => true, 'label' => __('Description'), 'value' => $values['start_section_desc'] ?? []],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });
                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'Footer';

                    $keys = [
                        'email',
                        'instagram',
                        'facebook',
                        'youtube'
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $options = [
                        'email' => ['type' => 'string', 'translatable' => false, 'label' => __('Site email'), 'value' => $values['email'] ?? ''],
                        'instagram' => ['type' => 'string', 'translatable' => false, 'label' => __('Instagram link'), 'value' => $values['instagram'] ?? ''],
                        'facebook' => ['type' => 'string', 'translatable' => false, 'label' => __('Facebook link'), 'value' => $values['facebook'] ?? ''],
                        'youtube' => ['type' => 'string', 'translatable' => false, 'label' => __('Youtube link'), 'value' => $values['youtube'] ?? ''],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });
                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'Film';

                    $keys = [
                        'film_url',
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $options = [
                        'film_url' => ['type' => 'string', 'translatable' => true, 'label' => __('Film url'), 'value' => $values['film_url'] ?? ''],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });
            })
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = __('site.videocourses');

                    $keys = [
                        'lesson_duration',
                        'course_duration',
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $authors = User::where('role', User::ROLE_AUTHOR)->get()->pluck('name', 'id');

                    $options = [
                        'lesson_duration' => ['type' => 'string', 'translatable' => false, 'label' => __('Average lesson duration (min)'), 'value' => $values['lesson_duration'] ?? ''],
                        'course_duration' => ['type' => 'string', 'translatable' => false, 'label' => __('Hours of study'), 'value' => $values['course_duration'] ?? ''],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });
                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'Site videos';

                    $keys = [
                        'team_section_video',
                        'home_page_bottom_video',
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $authors = User::where('role', User::ROLE_AUTHOR)->get()->pluck('name', 'id');

                    $options = [
                        'team_section_video' => ['type' => 'string', 'translatable' => false, 'label' => __('Team section video'), 'value' => $values['team_section_video'] ?? ''],
                        'home_page_bottom_video' => ['type' => 'string', 'translatable' => false, 'label' => __('Home page bottom video'), 'value' => $values['home_page_bottom_video'] ?? ''],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });

                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'Adaptation';

                    $keys = [
                        'creators_count',
                        'hours_count',
                        'month_access',
                        'desc',
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $options = [
                        'creators_count' => ['type' => 'number', 'translatable' => false, 'label' => __('Creators'), 'value' => $values['creators_count'] ?? 0],
                        'hours_count' => ['type' => 'number', 'translatable' => false, 'label' => __('Hours'), 'value' => $values['hours_count'] ?? 0],
                        'month_access' => ['type' => 'number', 'translatable' => false, 'label' => __('Month access'), 'value' => $values['month_access'] ?? 0],
                        'desc' => ['type' => 'text', 'translatable' => true, 'label' => __('Description'), 'value' => $values['desc'] ?? ''],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });

                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'About page';

                    $keys = [
                        'about_banner_top_text',
                        'about_banner_text',
                        'about_author_name',
                        'about_author_surname',
                        'about_author_role',
                        'about_address_1',
                        'about_address_2',
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $options = [
                        'about_banner_top_text' => ['type' => 'string', 'translatable' => true, 'label' => __('Banner top text'), 'value' => $values['about_banner_top_text'] ?? ''],
                        'about_banner_text' => ['type' => 'string', 'translatable' => true, 'label' => __('Banner text'), 'value' => $values['about_banner_text'] ?? ''],
                        'about_author_name' => ['type' => 'string', 'translatable' => true, 'label' => __('Author name'), 'value' => $values['about_author_name'] ?? ''],
                        'about_author_surname' => ['type' => 'string', 'translatable' => true, 'label' => __('Author surname'), 'value' => $values['about_author_surname'] ?? ''],
                        'about_author_role' => ['type' => 'string', 'translatable' => true, 'label' => __('Author role'), 'value' => $values['about_author_role'] ?? ''],
                        'about_address_1' => ['type' => 'string', 'translatable' => true, 'label' => __('Address 1'), 'value' => $values['about_address_1'] ?? ''],
                        'about_address_2' => ['type' => 'string', 'translatable' => true, 'label' => __('Address 2'), 'value' => $values['about_address_2'] ?? ''],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });

                $row->column(4, function (Column $column) {
                    $langs = LaravelLocalization::getLocalesOrder();
                    $optionsGroupTitle = 'Platform';

                    $keys = [
                        'lessons_count',
                        'lesson_duration_avg',
                        'lessons_we_add',
                        'interesting_content_hours',
                        'users_amount',
                        'about_section_desc',
                        'about_section_subtext',
                        'about_section_purpose'
                    ];

                    $values = $this->optionsService->getOptionValuesByKeys($keys);

                    $options = [
                        'lessons_count' => ['type' => 'number', 'translatable' => false, 'label' => __('Lessons count'), 'value' => $values['lessons_count'] ?? ''],
                        'lesson_duration_avg' => ['type' => 'number', 'translatable' => false, 'label' => __('Average lessons duration'), 'value' => $values['lesson_duration_avg'] ?? ''],
                        'lessons_we_add' => ['type' => 'number', 'translatable' => false, 'label' => __('Amount of lessons we add every month'), 'value' => $values['lessons_we_add'] ?? ''],
                        'interesting_content_hours' => ['type' => 'number', 'translatable' => false, 'label' => __('Interesting content hours'), 'value' => $values['interesting_content_hours'] ?? ''],
                        'users_amount' => ['type' => 'number', 'translatable' => false, 'label' => __('Amount of users who purchased subscription'), 'value' => $values['users_amount'] ?? ''],
                        'about_section_desc' => ['type' => 'text', 'translatable' => true, 'label' => __('Description'), 'value' => $values['about_section_desc'] ?? []],
                        'about_section_subtext' => ['type' => 'text', 'translatable' => true, 'label' => __('Subtext'), 'value' => $values['about_section_subtext'] ?? []],
                        'about_section_purpose' => ['type' => 'text', 'translatable' => true, 'label' => __('Purpose'), 'value' => $values['about_section_purpose'] ?? []],
                    ];

                    $column->append(view('admin.options.modal', compact('langs', 'optionsGroupTitle', 'options')));
                });
            });
    }

    public function optionGroupSave(Request $request){
        if(!$this->optionsService->optionGroupSave($request->except('_token'))){
            return back()->with('error', __('site.error'));
        }

        return back();
    }
}
