<?php

namespace App\Traits;

use App\Enums\OrderableType;

trait ProductTrait
{
    public function prepareCartProducts(array $cartItems, int $userId)
    {
        $products = [];

        foreach ($cartItems as $item) {
            $products[] = [
                "orderable_type" => OrderableType::from($item->getExtraInfo()['type'])->model(),
                "orderable_id" => $item->getId(),
                "user_id" => $userId,
                "count" => $item->getQuantity(),
                "price" => $item->getPrice(),
            ];
        }

        if (! $this->productsValid($products)) {
            return false;
        }

        return $products;
    }

    public function productsValid(array $products) : bool
    {
        foreach ($products as $product) {
            if (app()->bound($product['orderable_type'])) {
                $entity = new $product['orderable_type'];

                if (! $entity::find($product['orderable_id'])) {
                    return false;
                }
            }
        }

        return true;
    }
}