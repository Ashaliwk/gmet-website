<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Shops;
use Illuminate\Http\Request;

class AdminShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->session()->exists('email')){

            return view('backend.shop', ['shops'=>Shops::get()]);
        } else{
            return view('backend.login');
        }
    }
    public function addShop()
    {
        return view('backend.shop-add');
    }


    public function submitShopRecord(Request $request)
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
            $ImageName = 'fs_shop_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/product'), $ImageName);
        $shops = new Shops();
        $shops->name = $request->name;
        $shops->price = $request->price;
        $shops->description = $request->description;
        $shops->image = $ImageName;
        $shops->status = $ADMIN_STATUS;
        $shops->save();
        return back()->withSuccess('Shop Record Added Successfully');
    }

    public function editShop($id)
    {
        // dd($id);
        $shops = Shops::where('id', $id)->first();
        return view('backend.shop-edit', ['shops' => $shops]);
    }

    public function updateShop(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
            ]
            );

        $shops = Shops::where('id', $id)->first();
        $MEMBER_STATUS = 1;
        if(isset($request->image))
        {
            $ImageName = 'fs_shop_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/product'), $ImageName);
            $shops->image = $ImageName;
        }

        $shops->name = $request->name;
        $shops->price = $request->price;
        $shops->description = $request->description;
        $shops->status = $MEMBER_STATUS;
        $shops->save();
        return back()->withSuccess('Shop Item Record Updated Successfully');
    }


    public function deleteShop($id)
    {
        $shops = Shops::where('id', $id)->first();
        $shops->delete();
        return back()->withSuccess('Shop Item Record Deleted Successfully');
    }
}
