<?php

namespace App;

class Cart
{
    public $products = null;
    public $totalPrice = 0;
    public $totalQuanty = 0;
    public $checkIsset = 0;

    public function __construct($cart)
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuanty = $cart->totalQuanty;
            $this->checkIsset = $cart->checkIsset;
        }
    }

    public function AddCart($input)
    {
        $check = false;
        $id = $input['productId'] . '-' . $input['color'] . '-' . $input['size'];
        $newProduct = ['quanty' => 0, 'price' => $input['price'], 'productInfo' => $input];
        // if ($this->products) {
        //     dd(1);
        if ($this->products && array_key_exists($id, $this->products)) {
            $newProduct = $this->products[$id];
            $check = true;
        } else {
            $newProduct['quanty'] += $input['quantity'];
            $newProduct['price'] = $newProduct['quanty'] * $input['price'];
            $this->products[$id] = $newProduct;
            $this->totalPrice += $input['quantity'] * $input['price'];
            $this->totalQuanty += $input['quantity'];
        }

        if ($check) {
            $this->checkIsset = $id;
        } else {
            $this->checkIsset = 0;
        }
    }

    public function DeleteItemCart($id)
    {
        $this->totalQuanty -= $this->products[$id]['quanty'];
        $this->totalPrice -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }

    public function UpdateItemCart($id, $quanty, $price = 0)
    {
        try {
            $this->products[$id]['quanty'] = ($quanty + $this->products[$id]['quanty']);
            $this->products[$id]['price'] = ($quanty + $this->products[$id]['quanty']) * $this->products[$id]['productInfo']['price'];

            $this->totalQuanty += $quanty;
            $this->totalPrice += $quanty * $this->products[$id]['productInfo']['price'];
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function UpdateItemCartToNumber($id, $quanty)
    {
        $this->totalQuanty -= $this->products[$id]['quanty'];
        $this->totalPrice -= $this->products[$id]['price'];

        $this->products[$id]['quanty'] = $quanty;
        $this->products[$id]['price'] = $quanty * $this->products[$id]['productInfo']['price'];

        $this->totalQuanty += $this->products[$id]['quanty'];
        $this->totalPrice += $this->products[$id]['price'];
    }
}
