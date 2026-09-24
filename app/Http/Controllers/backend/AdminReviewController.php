<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Reviews;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->exists('email')){

            return view('backend.review', [
                'reviews' => Reviews::with(['room', 'booking'])->latest()->get(),
            ]);
        } else{
            return view('backend.login');
        }
    }
    public function addReview()
    {
        return view('backend.review-add');
    }


    public function submitReviewRecord(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'country' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
            ]
            );
            $ADMIN_STATUS = 1;
            $ImageName = 'fs_review_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/product'), $ImageName);
        $reviews = new Reviews();
        $reviews->name = $request->name;
        $reviews->country = $request->country;
        $reviews->description = $request->description;
        $reviews->image = $ImageName;
        $reviews->status = $ADMIN_STATUS;
        $reviews->save();
        return back()->withSuccess('Review Record Added Successfully');
    }

    public function editReview($id)
    {
        // dd($id);
        $reviews = Reviews::where('id', $id)->first();
        return view('backend.review-edit', ['reviews' => $reviews]);
    }

    public function updateReview(Request $request, $id)
    {

        $request->validate(
            [
                'name' => 'required',
                'country' => 'required',
                'description' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png|max:10000',
            ]
            );

        $reviews = Reviews::where('id', $id)->first();
        $MEMBER_STATUS = 1;
        if(isset($request->image))
        {
            $ImageName = 'fs_review_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('backend/images/product'), $ImageName);
            $reviews->image = $ImageName;
        }

        $reviews->name = $request->name;
        $reviews->country = $request->country;
        $reviews->description = $request->description;
        $reviews->status = $MEMBER_STATUS;
        $reviews->save();
        return back()->withSuccess('Review Item Record Updated Successfully');
    }


    public function deleteReview($id)
    {
        $reviews = Reviews::where('id', $id)->first();
        $reviews->delete();
        return back()->withSuccess('Review Item Record Deleted Successfully');
    }

    public function approveReview($id)
    {
        $review = Reviews::where('id', $id)->firstOrFail();
        $review->status = $review->status == 1 ? 0 : 1;
        $review->save();

        return back()->withSuccess($review->status == 1 ? 'Review published successfully.' : 'Review hidden successfully.');
    }
}
