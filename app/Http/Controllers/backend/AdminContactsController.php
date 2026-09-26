<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Contact;

class AdminContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return view('backend.contacts', compact('contacts'));
    }

    public function markRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = 'read';
        $contact->save();
        return back()->with('success', 'Message marked as read.');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/admin/contacts')->with('success', 'Inquiry deleted successfully!');
    }
}


/* THIS WEBSITE IS MADE BY MUHAMMAD ALI */