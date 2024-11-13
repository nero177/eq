<?php
use App\Enums\LessonType;
use App\Enums\OrderableType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Services\Admin\OptionsService;
use App\Services\AccessService;
use App\Models\SiteFile;
use Illuminate\Support\Facades\Log;

if (! function_exists('localize_url')) {
    function localize_url($url = null, $locale = null)
    {
        $url = LaravelLocalization::localizeUrl($url, $locale);
        return $url;
    }
}

if (! function_exists('get_option')) {
    function get_option(string $key)
    {
        $option = OptionsService::getOption($key);

        if(!$option){
            return '';
        }

        return $option->value;
    }
}

if (! function_exists('is_purchased')) {
    function is_purchased(int $id, OrderableType $type)
    {
        return AccessService::isPurchased($id, $type);
    }
}

if (! function_exists('has_lesson_access')) {
    function has_Lesson_access(int $id, LessonType $type)
    {
        return AccessService::hasLessonAccess($id, $type);
    }
}

if (! function_exists('get_current_locale')) {
    function get_current_locale()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (! function_exists('get_current_locale')) {
    function get_current_locale()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (!function_exists('format_price')) {
    function format_price($price)
    {
        return number_format($price, 0, '.', ' ');
    }
}

if (!function_exists('retrieve_media_by_name')) {
    function retrieve_media_url_by_name($name)
    {
        $record = SiteFile::where('title', $name)->first();
        
        if(!$record){
            return '';
        }
        
        return $record->getFirstMediaUrl('file');
    }
}

if (!function_exists('loginfo')) {
    function loginfo($data)
    {
        Log::info($data);
    }
}

if (! function_exists('transliterate')) {
    function transliterate(string $str, $lang = 'uk'){
        if($lang == 'uk'){
            $chars = array(
                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'H', 'Ґ' => 'G', 
                'Д' => 'D', 'Е' => 'E', 'Є' => 'Ye', 'Ж' => 'Zh', 'З' => 'Z', 
                'И' => 'Y', 'І' => 'I', 'Ї' => 'Yi', 'Й' => 'Y', 'К' => 'K', 
                'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 
                'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 
                'Х' => 'Kh', 'Ц' => 'Ts', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch', 
                'Ь' => '', 'Ю' => 'Yu', 'Я' => 'Ya', 
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'h', 'ґ' => 'g', 
                'д' => 'd', 'е' => 'e', 'є' => 'ye', 'ж' => 'zh', 'з' => 'z', 
                'и' => 'y', 'і' => 'i', 'ї' => 'yi', 'й' => 'y', 'к' => 'k', 
                'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 
                'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 
                'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 
                'ь' => '', 'ю' => 'yu', 'я' => 'ya', ' ' => '-', ' - ' => '-', '|' => '-', ' | ' => '-',
                '/' => '-', ' / ' => '-', ',' => '-', '.' => '', '%' => '-', '-%-' => '-', ' % ' => '-', '&' => '-', '~' => '-',
                ', ' => '-', 'ы' => 'y', 'Ы' => 'Y', ':-' => '-', ':' => '-',
            );
        }
        
        return strtolower(strtr($str, $chars));
    }
}
