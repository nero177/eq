<?php

namespace App\Services;
use App\Enums\OrderableType;
use App\Models\Favorite;

class FavoritesService
{
    public function add($id, OrderableType $type)
    {
        $user = auth()->user();

        if($user->favorites()->where([['item_id', $id], ['item_type', $type->value]])->exists()){
            return false;
        }

        $fav = new Favorite();

        $fav->item_id = $id;
        $fav->item_type = $type->model();
        $fav->user_id = $user->id;

        $fav->save();
    }

    public function removeAll(){
        $user = auth()->user();
        return $user->favorites()->delete();
    }

    public function remove($id){
        $user = auth()->user();
        return $user->favorites()->where('item_id', $id)->delete();
    }

    public static function userFavorite($lessonId){
        $user = auth()->user();

        if(!$user){
            return;
        }

        return $user->favorites()->where('item_id', $lessonId)->exists();
    }
}