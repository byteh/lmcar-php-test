<?php

namespace App\Service;

class ProductHandler
{

    public function GetTotalPrice($products)
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $price = $product['price'] ?: 0;
            $totalPrice += $price;
        }
        return $totalPrice;
    }

    public function filterForDessert($products) {
        $p = array();
        foreach ($products as $product) {
            if ("Dessert" == $product['type']) {
                $p[] = $product;
            }
        }
        return $p;
    }

    public function sortByPrice($products) {
        foreach ($products as $key => $value) {
            $price[$key] = $value['price'];
            $id[$key] = $value['id'];
        }
        array_multisort($price, SORT_DESC, $id, $products);
        return $products;
    }

    public function SortByPriceAndFilterDessert($products) {
        $p = $this->sortByPrice($products);
        $p = $this->filterForDessert($p);
        return $p;
    }


    public function ChangeTimeFmt($products) {
        $i =0;
        foreach ($products as $product) {
            $products[$i]['create_at_s'] = strtotime($product['create_at']);
            $i++;
        }
        return $products;
    }
}