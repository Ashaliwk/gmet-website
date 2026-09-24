<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Admins;
use App\Models\backend\Services;
use App\Models\backend\Team;
use App\Models\backend\Projects;
use App\Models\backend\Partners;
use App\Models\backend\Contact;
use App\Models\backend\FAQs;
use App\Models\backend\Reviews;

class AdminHomeController extends Controller
{
    public function index()
    {
        if (session()->has('email')) {
            $Name = session('first_name') . " " . session('last_name');

            $TotalAdmins   = Admins::count();
            $TotalServices = Services::count();
            $TotalTeam     = Team::count();
            $TotalProjects = Projects::count();
            $TotalPartners = Partners::count();
            $TotalContacts = Contact::count();
            $TotalFAQs     = FAQs::count();
            $TotalReviews  = Reviews::count();

            // Backwards compatibility aliases
            $TotalShopProduct = $TotalPartners;
            $Totalrooms       = $TotalServices;

            $recentInquiries = Contact::orderBy('created_at', 'desc')->take(5)->get();
            $recentProjects  = Projects::orderBy('created_at', 'desc')->take(5)->get();

            return view('backend.index', compact(
                'Name',
                'TotalAdmins',
                'TotalServices',
                'TotalTeam',
                'TotalProjects',
                'TotalPartners',
                'TotalContacts',
                'TotalFAQs',
                'TotalReviews',
                'TotalShopProduct',
                'Totalrooms',
                'recentInquiries',
                'recentProjects'
            ));
        } else {
            return view('backend.login');
        }
    }

    public function registerAdmin()
    {
        $url = url('/admin/register');
        return view('backend.admin-add', compact('url'));
    }

    public function submitAdminRecord(Request $request)
    {
        $request->validate([
            'first_name'       => 'required',
            'last_name'        => 'required',
            'email'            => 'required|email|unique:admins,email',
            'password'         => 'required',
            'confirm_password' => 'required|same:password',
            'contact'          => 'required'
        ]);

        $admin = new Admins();
        $admin->first_name = $request->first_name;
        $admin->last_name  = $request->last_name;
        $admin->email      = $request->email;
        $admin->contact    = $request->contact;
        $admin->password   = $request->password;
        $admin->status     = 1;
        $admin->save();

        return redirect('/admin/admins-list')->withSuccess('Admin added successfully!');
    }

    public function showAdminRecord()
    {
        $admins = Admins::all();
        return view('backend.admins-list', compact('admins'));
    }

    public function deleteAdminRecord(string $id)
    {
        $admin = Admins::find($id);
        if ($admin) {
            $admin->delete();
        }
        return redirect('/admin/admins-list')->withSuccess('Admin deleted successfully!');
    }

    public function editAdminRecord($id)
    {
        $admin = Admins::find($id);

        if (!$admin) {
            return redirect('/admin/admins-list');
        }

        $url = url('/admin/update') . "/" . $id;
        return view('backend.admin-add', compact('admin', 'url'));
    }

    public function updateAdminRecord(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'contact'    => 'required'
        ]);

        $admin = Admins::findOrFail($id);
        $admin->first_name = $request->first_name;
        $admin->last_name  = $request->last_name;
        $admin->email      = $request->email;
        $admin->contact    = $request->contact;
        if ($request->filled('password')) {
            $admin->password = $request->password;
        }
        $admin->save();

        return redirect('/admin/admins-list')->withSuccess('Admin updated successfully!');
    }
}