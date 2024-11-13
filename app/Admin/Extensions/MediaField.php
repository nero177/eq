<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;
use Illuminate\Support\Str;

class MediaField extends Field
{
    protected $view = 'admin.fields.media-field';

    public function render()
    {
        $media = $this->form->model()->hasMedia( $this->column ) ? $this->form->model()->getFirstMedia( $this->column ) : null;
        
        $this->addVariables([
            'media' => $media,
            'deleteUrl' => $media ? '/admin/delete-media/' . $media->uuid : null,
            'id' => Str::uuid()
        ]);
        
        return parent::render();
    }
}
