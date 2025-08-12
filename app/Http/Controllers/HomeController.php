<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Faq;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->take(3)->get();
        $partners = Partner::active()->ordered()->get();
        $faqs = Faq::active()->ordered()->get();
        $featuredGallery = Gallery::featured()->latest()->take(6)->get();

        return view('home', compact('services', 'partners', 'faqs', 'featuredGallery'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function services()
    {
        $services = Service::active()->ordered()->get();
        return view('services', compact('services'));
    }

    public function gallery(Request $request)
    {
        $category = $request->get('category', 'all');
        $galleries = Gallery::byCategory($category)->latest()->paginate(12);
        $categories = Gallery::distinct('category')->pluck('category');
        
        return view('gallery', compact('galleries', 'categories', 'category'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'organization' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contact = Contact::create($validated);

        // Send email notification (optional)
        try {
            Mail::to(config('mail.admin_email', 'admin@csirt-pali.org'))
                ->send(new ContactFormMail($contact));
        } catch (\Exception $e) {
            \Log::error('Contact form email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully!');
    }
}

