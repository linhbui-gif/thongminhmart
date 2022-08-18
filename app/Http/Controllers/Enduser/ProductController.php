<?php

namespace App\Http\Controllers\Enduser;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product_category;
use App\Product_tags;
use App\Comment;
use Illuminate\Http\Request;
use App\Product_products;
use Illuminate\Support\Facades\View;

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
        try {
            $quanty = $request->quanty;
            $id = $request->id;
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->UpdateItemCartToNumber($id, $quanty);
            $request->session()->put('Cart', $newCart);

            return redirect()->back()->with('success', 'Cập nhập sản phẩm thành công');

        } catch (\Exception $e) {
            dd($e->getMessage());
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
        try {
            // session()->forget('Cart'); die();
            $arrInput = $request->input();
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->AddCart($arrInput);
            
            if ($newCart->checkIsset != 0) {
                $quanty = $request->quantity;
                // $oldCart = Session('Cart') ? Session('Cart') : null;
                // $newCartUd = new Cart($oldCart);
                $newCart->UpdateItemCart($newCart->checkIsset, $quanty);
                session()->put('Cart', $newCart);
            } else {
                session()->put('Cart', $newCart);
            }
            
            // return json_encode(['status' => 1, 'data' => $newCart, 'message' => 'Đã thêm vào rỏ hàng']);
            $productId = $request->productId;
            // session()->flash('success', 'Đã thêm vào rỏ hàng');
            if ($request->type == 'checkout') {
                // return redirect()->route('product.checkout');
                return json_encode(['status' => 1, 'data' => route('product.checkout'), 'message' => 'Đã thêm vào rỏ hàng']);
            }
            // View::share('totalPrice_prod_detail', Session('Cart')->totalPrice??0);
            $html = view(config("edushop.end-user.pathView") . "productCart", compact('productId'))->render();

            return response()->json([
                'status' => true,
                'html' => $html,
                'totalPrice_prod_detail' => number_format(Session('Cart')->totalPrice??0). 'đ',
                'message' => 'Đã thêm vào rỏ hàng',
            ]);
        } catch (\Exception $e) {
            dd($e);
        }

        // $product = Product_products::findOrFail($request->product_id);
        // $cart = session()->get('cart', []);
        // if(!empty($cart[$request->product_id])) {

        //     if(!empty($cart[$request->product_id]['options'])) {
        //         foreach ($cart[$request->product_id]['options'] as $k => &$options) {
        //                     if ((int)$options['color'] === (int)$request->color_id && (int)$options['size'] === (int)$request->size_id) {
        //                         $cart[$request->product_id]['options'][$k]['quantity'] = (int)$options['quantity'] + (int)$request->quantity;
        //                         session()->put('cart', $cart);
        //                     } else {

        //                         array_push($cart[$request->product_id]['options'],
        //                             [
        //                                 "name" => $product->name,
        //                                 "quantity" => (int)$request->quantity,
        //                                 "price" => $product->price_final,
        //                                 "image" => $product->url_picture,
        //                                 "color" => $request->color_id,
        //                                 "size" => $request->size_id,
        //                             ]);
        //                         $cart[$request->product_id]['options'][$k] = $options;
        //                         session()->put('cart', $cart);
        //                     }

        //         }
        //     }
        // } else {
        //     $cart[$request->product_id] = [
        //         "name" => $product->name,
        //         "quantity" => 1,
        //         "price" => $product->price_final,
        //         "image" => $product->url_picture,
        //         "options" => [
        //             $request->color_id => [
        //                 "name" => $product->name,
        //                 "quantity" =>  (int) $request->quantity,
        //                 "price" => $product->price_final,
        //                 "image" => $product->url_picture,
        //                 "color" => $request->color_id,
        //                 "size" => $request->size_id
        //             ]
        //         ]
        //     ];
        //     session()->put('cart', $cart);
        // }
        //     return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }
    public function delCart(Request $request){
        try {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->DeleteItemCart($request->id);
            if (count($newCart->products) > 0) {
                $request->session()->put('Cart', $newCart);
            } else {
                $request->session()->forget('Cart');
            }
            $productId = $request->productId;

            if ($request->action) {
                return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công');
            }

            return view(config("edushop.end-user.pathView") . "productCart", compact('productId'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
   public function checkout(Request $request){
       return view(config("edushop.end-user.pathView") . "checkout");
   }
    public function productDetail($id)
    {
        $product = Product_products::where('id', $id)->where('status', 'active')->first();
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
