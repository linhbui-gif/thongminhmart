<?php

namespace App\Http\Controllers\Api;

use App\Product_category;
use App\Product_tags;
use Illuminate\Http\Request;
use App\Product_products;
use App\Http\Controllers\Api\BaseController as BaseController;

class ProductApiController extends BaseController
{
    public function list(Request $request){
        $products = Product_products::where('status','active');

        // fillter
        if($request->name ){
            $products->where('name', 'like', '%'.$request->name.'%');
        }
        if($request->price){
            $p = explode(',', $request->price);
            $products->whereBetween('price_final',array($p[0],$p[1]));
        }
        // sắp xếp
        $products->orderBy('id','DESC');
        // phân trang
        $products = $products->paginate(8);
        $data['products'] = $products;
        foreach ($data['products'] as $da){
            $da->picture = $da->getImage();

            $test =  json_decode($da->gallery,true);
            if (!empty($test)){
                $a = [];
                foreach($test as $t) {
                    $a[] = asset('images/product_products/'.$t);
                }
                $da->gallery = json_encode($a);
            }
        }
        return $this->sendResponse($data, 'Lấy danh sách sản phẩm thành công');
    }
    public function show($product_slug){
        $product = Product_products::where('slug', $product_slug)->where('status', 'active')->first();
        $product->picture = $product->getImage();
        $test =  json_decode($product->gallery,true);
        if (!empty($test)){
            $a = [];
            foreach($test as $t) {
                $a[] = asset('images/product_products/'.$t);
            }
            $product->gallery = json_encode($a);
        }
        $product_tag = Product_tags::where('id', $product->category_id)->get();
        if(!$product){
            return $this->sendError('Không tồn tại sản phẩm nào', 'error');
        }
        $data['product'] = $product;
        $data['comments'] = $product->comments('parent_id', 0)->where('type','product')->get();
        return $this->sendResponse([
            "data" => $data,
            "product_tag" => $product_tag,
            'comments' => $data['comments']
        ], 'Show sản phẩm thành công');

    }
    public function productListByCategory(Request $request, $slug_category){

        $category = Product_category::where('slug', $slug_category)->where('status','active')->first();
        $category->picture = $category->getImage();
        if(!$category){
            Product_category::where('id', $slug_category)->where('status','active')->first();
        }
        if(!$category){
            return $this->sendError('Không tồn tại sản phẩm nào', 'error');
        }

        $products = $category->products()->where('product_products.status','active');
        // fillter

        // sắp xếp
        $products->orderBy('product_products.id','DESC');
        // phân trang
        $products = $products->paginate(8);

        $data['products'] = $products;
        $data['category'] = $category;
        return $this->sendResponse($data, 'Lấy danh sách sản phẩm thành công');

    }
    public function category(){
        $data = Product_category::where('status','active')->latest()->paginate(8);
        foreach ($data as $da){
            $da->picture = $da->getImage();
        }
        if($data){
            return $this->sendResponse($data, 'Lấy danh mục sản phẩm thành công');
        }
        else{
            return $this->sendError('Không tồn tại danh mục sản phẩm nào', 'error');
        }
    }
}
