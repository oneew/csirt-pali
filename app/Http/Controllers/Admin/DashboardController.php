<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $stats = [
            'users' => User::count(),
            'services' => Service::count(),
            'gallery_items' => Gallery::count(),
            'partners' => Partner::count(),
            'unread_contacts' => Contact::unread()->count(),
            'total_contacts' => Contact::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentUsers'));
    }
}
