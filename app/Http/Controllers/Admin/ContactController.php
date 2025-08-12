<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $contacts = Contact::when($status !== 'all', function ($query) use ($status) {
            return $query->where('status', $status);
        })->latest()->paginate(15);

        return view('admin.contacts.index', compact('contacts', 'status'));
    }

    public function show(Contact $contact)
    {
        $contact->markAsRead();
        return view('admin.contacts.show', compact('contact'));
    }

    public function markAsReplied(Contact $contact)
    {
        $contact->markAsReplied();
        
        return back()->with('success', 'Contact marked as replied!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully!');
    }
}