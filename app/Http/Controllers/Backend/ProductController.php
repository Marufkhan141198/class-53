<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productCreate()
        {
            $categories = Category::get();
            $subCategories = SubCategory::get();
            return view('backend.product.create', compact('categories','subCategories'));
        }

        public function productStore(Request $request)
        {
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->cat_id = $request->cat_id;
            $product->sub_cat_id = $request->sub_cat_id;
            $product->sku_code = $request->sku_code;
            $product->qty = $request->qty;
            $product->product_type = $request->product_type;
            $product->regular_price = $request->regular_price;
            $product->buying_price = $request->buying_price;
            $product->discount_price = $request->discount_price;
            $product->description = $request->description;
            $product->product_policy = $request->product_policy;

            if(isset($request->image)){
            $imageName = rand().'-product-'.'.'.$request->image->extension();
            $request->image->move('backend/image/product/',$imageName);
            $product->image = $imageName;
        }
        $product->save();

        //add color...
        if(isset($request->color_name) && $request->color_name[0] != null){
            foreach($request->color_name as $singleColor){
            $color = new Color();
            $color->color_name = $singleColor;
            $color->slug = str::slug($singleColor);
            $color->product_id = $product->id;
            $color->save(); 
            }
        }

        //add size...
        if(isset($request->size_name) && $request->size_name[0] != null){
            foreach($request->size_name as $singleSize){
            $size = new Size();
            $size->size_name = $singleSize;
            $size->slug = str::slug($singleSize);
            $size->product_id = $product->id;
            $size->save();
            }
        }
        //gallery Image...

        if(isset($request->gallery_image)){
            foreach($request->gallery_image as $singleImage){
            $galleryImage = new GalleryImage();
            $galleryImage->product_id = $product->id;
            $imageName = rand().'-galleryImage-'.'.'.$singleImage->extension();
            $singleImage->move('backend/image/galleryimage/',$imageName);
            $galleryImage->image = $imageName;
            $galleryImage->save();
            }
        }

        return redirect()->back();

        }

        public function productList()
        {
            $products = Product::with('category','subCategory')->get();
            return view('backend.product.list',compact('products'));

        }
        public function productDelete($id)
        {
            $product = Product::find($id);
            if($product->image && file_exists('backend/image/product/'.$product->image)){
            unlink('backend/image/product/'.$product->image);
        }

        //color delete..
        $colors = Color::where('product_id', $product->id)->get();
        foreach($colors as $color){
            $color->delete();
        }
        //size delete..
        $sizes = Size::where('product_id', $product->id)->get();
        foreach($sizes as $size){
            $size->delete();
        }

        //galleryImage...
        $galleryImages = GalleryImage::where('product_id', $product->id)->get();
        foreach($galleryImages as $singleImage){
            if($singleImage->image && file_exists('backend/image/galleryimage/'.$singleImage->image)){
            unlink('backend/image/galleryimage/'.$singleImage->image);
        }
        $singleImage->delete();
        }
        $product->delete();
        return redirect()->back();

        }

        public function productEdit($id)
        {
            $product = Product::where('id',$id)->with('color','size','galleryImage')->first();
            $categories = Category::all();
            $subCategories = SubCategory::all();
            return view('backend.product.edit',compact('product','categories','subCategories'));


            
        }

        public function productUpdate(Request $request, $id)
        {
            $product = Product::find($id);
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->sku_code = $request->sku_code;
            $product->cat_id = $request->cat_id;
            $product->sub_cat_id = $request->sub_cat_id;
            $product->qty = $request->qty;
            $product->buying_price = $request->buying_price;
            $product->regular_price = $request->regular_price;
            $product->discount_price = $request->discount_price;
            $product->product_type = $request->product_type;
            $product->product_policy = $request->product_policy;

            if(isset($request->image)){
                if($product->image && file_exists('backend/image/product/'.$product->image)){
                unlink('backend/image/product/'.$product->image);
            }
            
            $imageName = rand().'-productup-'.'.'.$request->image->extension();
            $request->image->move('backend/image/product/',$imageName);
            $product->image = $imageName;
        }
        $product->save();
        //Add Color..
        if(isset($request->color_name) && $request->color_name[0] != null){

            $colors = Color::where('product_id',$product->id)->get();
            foreach($colors as $singleColor){
                $singleColor->delete();
            }
            foreach($request->color_name as $singleColor){
            $color = new Color();
            $color->color_name = $singleColor;
            $color->slug = str::slug($singleColor);
            $color->product_id = $product->id;
            $color->save(); 
            }
        }
        //add size...
        if(isset($request->size_name) && $request->size_name[0] != null){
            $sizes = Size::where('product_id',$product->id)->get();
            foreach($sizes as $singleSize){
                $singleSize->delete();
            }
            foreach($request->size_name as $singleSize){
            $size = new Size();
            $size->size_name = $singleSize;
            $size->slug = str::slug($singleSize);
            $size->product_id = $product->id;
            $size->save();
            }
        }

        if(isset($request->gallery_image)){
            $galleryImage = GalleryImage::where('product_id',$product->id)->get();
            foreach($galleryImage as $singleImage){
                if($singleImage->image && file_exists('backend/image/galleryimage/'.$singleImage->image)){
                  unlink('backend/image/galleryimage/'.$singleImage->image);
            }
                $singleImage->delete();
            }
            foreach($request->gallery_image as $singleImage){
            $galleryImage = new GalleryImage();
            $galleryImage->product_id = $product->id;
            $imageName = rand().'-galleryImage-'.'.'.$singleImage->extension();
            $singleImage->move('backend/image/galleryimage/',$imageName);
            $galleryImage->image = $imageName;
            $galleryImage->save();
            }
        }

        return redirect()->back();



        }
        public function colorDelete($id)
        {
            $color = Color::find($id);
            $color->delete();
            return redirect()->back();
        }

        public function sizeDelete($id)
        {
            $size = Size::find($id);
            $size->delete();
            return redirect()->back();
        }

        public function galleryImageDelete($id)
    {
        $galleryImage = GalleryImage::find($id);
        if($galleryImage->image && file_exists('backend/image/galleryimage/'.$galleryImage->image)){
                  unlink('backend/image/galleryimage/'.$galleryImage->image);
            }
            $galleryImage->delete();
            return redirect()->back();
    }

    public function galleryImageEdit($id)
    {
        $galleryImage = GalleryImage::with('product')->where('id',$id)->first();
        return view ('backend.product.editgalleryimage',compact('galleryImage'));
    }

    public function galleryImageUpdate(Request $request,$id)
    {
        $galleryImage = GalleryImage::find($id);
        if(isset($request->image)){
            if($galleryImage->image && file_exists('backend/image/galleryimage/'.$galleryImage->image)){
                  unlink('backend/image/galleryimage/'.$galleryImage->image);
            }
            $imageName = rand().'-galleryImage-'.'.'.$request->image->extension();
            $request->image->move('backend/image/galleryimage/',$imageName);
        
    }
       $galleryImage->image = $imageName;
       $galleryImage->save();
       return redirect('/admin/product/edit/'.$galleryImage->product_id);
    
     }
}