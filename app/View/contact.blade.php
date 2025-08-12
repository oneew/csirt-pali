@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="hero" style="padding: 140px 0 60px; min-height: 50vh;">
    <div class="hero-container" style="text-align: center;">
        <div>
            <h1 class="hero-title" style="font-size: 2.5rem;">Contact Us</h1>
            <p class="hero-subtitle">Get in touch with CSIRT PALI for cybersecurity collaboration</p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-6 text-gray-900">Send us a message</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="organization" class="block text-sm font-medium text-gray-700 mb-2">Organization</label>
                            <input type="text" name="organization" id="organization" value="{{ old('organization') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('organization')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea name="message" id="message" rows="6" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-lg hover:from-blue-700 hover:to-purple-700 transition duration-300">
                            <i class="fas fa-paper-plane mr-2"></i>Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">Get in Touch</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-blue-600 mt-1 mr-4"></i>
                                <div>
                                    <p class="font-medium">Email</p>
                                    <p class="text-gray-600">info@csirt-pali.org</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <i class="fas fa-globe text-blue-600 mt-1 mr-4"></i>
                                <div>
                                    <p class="font-medium">Network Coverage</p>
                                    <p class="text-gray-600">Americas Region</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <i class="fas fa-shield-alt text-blue-600 mt-1 mr-4"></i>
                                <div>
                                    <p class="font-medium">Mission</p>
                                    <p class="text-gray-600">Cybersecurity Incident Response & Collaboration</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-8 rounded-lg text-white">
                        <h3 class="text-xl font-bold mb-4">Join Our Network</h3>
                        <p class="mb-4">Are you a government CSIRT looking to enhance your cybersecurity capabilities through regional collaboration?</p>
                        <a href="{{ route('services') }}" class="inline-block bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
