<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;
use Illuminate\Support\Str;

class TranslatableTextarea extends Field
{
    protected $view = 'admin.fields.translatable-textarea';

    public function render()
    {
        $editable = $this->form->model();
        $descTranslationsRaw = json_decode($editable->getRawOriginal('desc'), true);

        $this->addVariables([
            'label' => 'label',
            'values' => $descTranslationsRaw
        ]);
        
        return parent::render();
    }
}
