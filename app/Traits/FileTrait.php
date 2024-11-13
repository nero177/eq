<?php

namespace App\Traits;

trait FileTrait
{
    public function addModelFileToCollection($request, $fileName, $collectionName = 'default', $deletePrev = false)
    {
        if($request->hasFile($fileName) && $request->file($fileName)->isValid()){
            if ($deletePrev) {
                $this->clearMediaCollection($collectionName);
            }

            return $this->addMediaFromRequest($fileName)->sanitizingFileName(function($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
             })->toMediaCollection($collectionName);
        }

        return null;
    }
}