<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Products;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->exists('email')){

            return view('backend.product', ['homeproducts'=>Products::get()]);
        } else{
            return view('backend.login');
        }
    }
    public function addProduct()
    {
        return view('backend.product-add');
    }


    public function submitProductRecord(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
            ]
            );
            $ADMIN_STATUS = 1;
            $ImageName = 'fs_product_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/product'), $ImageName);
        $homeproducts = new Products();
        $homeproducts->name = $request->name;
        $homeproducts->price = $request->price;
        $homeproducts->description = $request->description;
        $homeproducts->image = $ImageName;
        $homeproducts->status = $ADMIN_STATUS;
        $homeproducts->save();
        return back()->withSuccess('Product Record Added Successfully');
    }

    public function editProduct($id)
    {
        // dd($id);
        $homeproducts = Products::where('id', $id)->first();
        return view('backend.product-edit', ['homeproducts' => $homeproducts]);
    }

    public function updateProduct(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
            ]
            );

        $homeproducts = Products::where('id', $id)->first();
        $MEMBER_STATUS = 1;
        if(isset($request->image))
        {
            $ImageName = 'fs_product_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/product'), $ImageName);
            $homeproducts->image = $ImageName;
        }

        $homeproducts->name = $request->name;
        $homeproducts->price = $request->price;
        $homeproducts->description = $request->description;
        $homeproducts->status = $MEMBER_STATUS;
        $homeproducts->save();
        return back()->withSuccess('Product Item Record Updated Successfully');
    }


    public function deleteProduct($id)
    {
        $homeproducts = Products::where('id', $id)->first();
        $homeproducts->delete();
        return back()->withSuccess('Product Item Record Deleted Successfully');
    }
}
