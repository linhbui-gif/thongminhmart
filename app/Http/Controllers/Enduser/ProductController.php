<?php

namespace App\Http\Controllers\Enduser;

use App\Http\Controllers\Controller;
use App\Product_category;
use App\Product_tags;
use App\Comment;
use Illuminate\Http\Request;
use App\Product_products;

class ProductController extends Controller
{
    public function __construct()
    {
        $_config = \App\Config::find(26);
        return view()->share('_config', $_config);
    }

    public function productList(Request $request)
    {

        $data['products'] = Product_products::where('status', 'active')->orderBy('order_no', 'asc')->get();
        $data['categories'] = Product_category::where('status', 'active')->orderBy('order_no', 'asc')->get();
        return view(config("edushop.end-user.pathView") . "productList")->with($data);
    }

    public function productListByCategory(Request $request, $slug_category)
    {
        $category = Product_category::where('slug', $slug_category)->where('status', 'active')->first();
        if (!$category) {
            $category = Product_category::where('id', $slug_category)->where('status', 'active')->first();
        }
        if (!$category) {
            return abort(404);
        }

        $products = $category->products()->where('product_products.status', 'active')->orderBy('order_no', 'asc')->get();
        $data['products'] = $products;
        $data['category'] = $category;
        
        return view(config("edushop.end-user.pathView") . "productListByCategory")->with($data);
    }

    public function cart()
    {
        $cart = (array)session('cart');
        return view(config("edushop.end-user.pathView") . "cart", compact('cart'));
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function addCart(Request $request)
    {

        $product = Product_products::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        if(!empty($cart[$request->product_id])) {

            if(!empty($cart[$request->product_id]['options'])) {
                foreach ($cart[$request->product_id]['options'] as $k => &$options) {
                            if ((int)$options['color'] === (int)$request->color_id && (int)$options['size'] === (int)$request->size_id) {
                                $cart[$request->product_id]['options'][$k]['quantity'] = (int)$options['quantity'] + (int)$request->quantity;
                                session()->put('cart', $cart);
                            } else {

                                array_push($cart[$request->product_id]['options'],
                                    [
                                        "name" => $product->name,
                                        "quantity" => (int)$request->quantity,
                                        "price" => $product->price_final,
                                        "image" => $product->url_picture,
                                        "color" => $request->color_id,
                                        "size" => $request->size_id,
                                    ]);
                                $cart[$request->product_id]['options'][$k] = $options;
                                session()->put('cart', $cart);
                            }

                }
            }
        } else {
            $cart[$request->product_id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price_final,
                "image" => $product->url_picture,
                "options" => [
                    $request->color_id => [
                        "name" => $product->name,
                        "quantity" =>  (int) $request->quantity,
                        "price" => $product->price_final,
                        "image" => $product->url_picture,
                        "color" => $request->color_id,
                        "size" => $request->size_id
                    ]
                ]
            ];
            session()->put('cart', $cart);
        }
            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }
   public function checkout(){
       return view(config("edushop.end-user.pathView") . "checkout");
   }
    public function productDetail($product_slug)
    {
        $product = Product_products::where('slug', $product_slug)->where('status', 'active')->first();
        if (isset($product->category->id)) {
            $idCategory = $product->category->id;
        }

        if (!$product) {
            abort(404);
        }
        $data['product'] = $product;
        if (isset($idCategory)){
            $data['productSameCategory'] = Product_products::where('category_id', $idCategory)->where('status', 'active')->get();
        }
        // dd($data);   
        return view(config("edushop.end-user.pathView") . "productDetail")->with($data);
    }

    public function productTagSlug(Request $request, $slug)
    {
        $params = $request->all();
        $tag = Product_tags::where('slug', $slug)->where('status', 'active')->first();
        if (!$tag) {
            return redirect()->route('product.productList');
        }
        $products = $tag->products()->where('product_products.status', 'active')->orderBy('id', 'desc')->get();
        $data['tag'] = $tag;
        $data['products'] = $products;
        return view(config("edushop.end-user.pathView") . "productTag")->with($data);
    }
}
