<?php

namespace App\Services\Admin;

use App\Models\Option;

class OptionsService
{
    public function optionGroupSave(array $options) : bool
    {
        $options = array_filter($options);

        foreach ($options as $optionKey => $optionData) {
            if (is_string($optionData) || count(array_filter($optionData)) !== 0) {
                Option::updateOrCreate(['key' => $optionKey], ['key' => $optionKey, 'value' => $optionData]);
            }
        }

        return true;
    }

    public function getOptionValuesByKeys(array $keys) : array
    {
        $fetchedOptions = Option::whereIn('key', $keys)->get();

        $values = [];

        foreach ($fetchedOptions as $fetchedOption) {
            $values[$fetchedOption->key] = count($fetchedOption->getTranslations('value')) > 0 ?
                $fetchedOption->getTranslations('value') : $fetchedOption->value;
        }

        return $values;
    }

    public static function getOption(string $key){
        $option = Option::where('key', $key)->first();
        return $option;
    }
}