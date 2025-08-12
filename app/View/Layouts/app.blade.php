<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CSIRT PALI') }} - @yield('title', 'Cybersecurity Network')</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @stack('styles')
    
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
</head>
<body class="font-inter antialiased">
    @if(request()->is('/'))
        @include('partials.secret-landing')
    @endif

    <div class="main-website @if(request()->is('/')) {{ 'hidden' }} @else {{ 'show' }} @endif" id="mainWebsite">
        @include('partials.header')
        
        <main>
            @yield('content')
        </main>
        
        @include('partials.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    @if(request()->is('/'))
        <script src="{{ asset('js/secret-landing.js') }}"></script>
    @endif
    @stack('scripts')
</body>
</html>

{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'CSIRT PALI') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .sidebar {
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        }
        .sidebar-link:hover {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
        }
        .sidebar-link.active {
            background: rgba(102, 126, 234, 0.2);
            border-left: 4px solid #667eea;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 min-h-screen text-white">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/Logo.png') }}" alt="CSIRT PALI" class="w-10 h-10">
                    <h1 class="text-xl font-bold">Admin Panel</h1>
                </div>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.services.index') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fas fa-shield-alt mr-3"></i>
                    Services
                </a>
                
                <a href="{{ route('admin.gallery.index') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="fas fa-images mr-3"></i>
                    Gallery
                </a>
                
                <a href="{{ route('admin.partners.index') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                    <i class="fas fa-handshake mr-3"></i>
                    Partners
                </a>
                
                <a href="{{ route('admin.faqs.index') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <i class="fas fa-question-circle mr-3"></i>
                    FAQs
                </a>
                
                <a href="{{ route('admin.contacts.index') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope mr-3"></i>
                    Contacts
                    @if($unreadContacts = App\Models\Contact::unread()->count())
                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadContacts }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center px-6 py-3 text-white hover:bg-blue-600 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-64 p-6">
                <div class="border-t border-gray-600 pt-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">Administrator</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="flex items-center text-sm text-gray-300 hover:text-white">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-semibold text-gray-800">
                            @yield('page-title', 'Dashboard')
                        </h2>
                        
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('home') }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                View Site
                            </a>
                            
                            <div class="text-sm text-gray-600">
                                Last login: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->diffForHumans() : 'Never' }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

{{-- resources/views/partials/secret-landing.blade.php --}}
<section class="secret-landing" id="secretLanding">
    <div class="classified-text">
        [ CLASSIFIED CYBERSECURITY NETWORK ]
    </div>

    <div class="access-code-container">
        <div style="color: #00ff41; margin-bottom: 1rem; font-weight: bold;">
            ENTER ACCESS SEQUENCE
        </div>
        <div class="code-display">
            <div class="code-digit" data-char="C">C</div>
            <div class="code-digit" data-char="S">S</div>
            <div class="code-digit" data-char="I">I</div>
            <div class="code-digit" data-char="R">R</div>
            <div class="code-digit" data-char="T">T</div>
            <div class="code-digit" data-char="-">-</div>
            <div class="code-digit" data-char="P">P</div>
            <div class="code-digit" data-char="A">A</div>
            <div class="code-digit" data-char="L">L</div>
            <div class="code-digit" data-char="I">I</div>
        </div>
        <button class="access-button" onclick="initiateAccess()">
            <i class="fas fa-unlock"></i> GRANT ACCESS
        </button>
        <div class="warning-text">
            ⚠ Unauthorized access is prohibited and monitored
        </div>
    </div>
</section>

{{-- resources/views/partials/header.blade.php --}}
<header class="header transparent">
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo.png') }}" alt="CSIRT_Pali Logo" class="logo">
                </a>
            </div>
            
            <button class="mobile-menu-toggle" id="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <div class="nav-menu" id="nav-menu">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                    </li>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="nav-link bg-transparent border-0">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

{{-- resources/views/partials/footer.blade.php --}}
<footer class="footer" id="contact">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="{{ asset('images/Logo.png') }}" alt="CSIRTAmericas Logo">
                </div>
                <div class="footer-info">
                    <p>&copy; {{ date('Y') }} CSIRT-PALI. All rights reserved.</p>
                    <p>Contact: info@csirt-pali.org</p>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Home - Cybersecurity Network')

@section('content')
<section class="hero" id="home">
    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title">Protecting the Americas in Cyberspace</h1>
            <p class="hero-subtitle">
                Network of Computer Security Incident Response Teams (CSIRTs) from government organizations across the Americas, fostering collaboration and strengthening cybersecurity capabilities
            </p>
            <a href="{{ route('services') }}" class="cta-btn">
                <i class="fas fa-shield-alt"></i>
                Explore Our Services
            </a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/bg2.png') }}" alt="Cybersecurity Illustration">
        </div>
    </div>
</section>

<section class="about-us-section" id="profile">
    <div class="about-us-container">
        <div class="about-us-photo">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo CSIRT" />
        </div>
        <div class="about-us-info">
            <h2>About Us</h2>
            <p class="about-us-info-text">
                CSIRT PALI is a collaborative network of cybersecurity incident response teams across the Americas, dedicated to strengthening cybersecurity, sharing critical information, and enhancing incident response capabilities among member countries. We are committed to building a safer and more resilient digital ecosystem through collaboration, training, and knowledge exchange.
            </p>
            <a href="{{ route('profile') }}" class="cta-btn" style="display: inline-flex; margin-top: 1rem;">
                <i class="fas fa-info-circle"></i>
                Learn More
            </a>
        </div>
    </div>
</section>

<section class="requirements">
    <div class="container">
        <div class="requirements-content">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-list">
                @foreach($faqs as $index => $faq)
                    <div class="faq-item">
                        <button type="button" class="faq-question">
                            {{ $index + 1 }}. {{ $faq->question }}
                            <span class="faq-icon">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><line x1="10" y1="4" x2="10" y2="16"/><line x1="4" y1="10" x2="16" y2="10"/></svg>
                                <svg class="icon-close" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="5" x2="15" y2="15"/><line x1="15" y1="5" x2="5" y2="15"/></svg>
                            </span>
                        </button>
                        <div class="faq-answer">{{ $faq->answer }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="services" id="servicios">
    <div class="container">
        <h2>Our Services</h2>
        <div class="services-grid">
            @foreach($services as $service)
                <div class="service-card">
                    <div class="service-icon">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    <h3 class="service-title">{{ $service->title }}</h3>
                    <p class="service-description">{{ $service->description }}</p>
                </div>
            @endforeach
        </div>
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('services') }}" class="cta-btn">
                <i class="fas fa-arrow-right"></i>
                View All Services
            </a>
        </div>
    </div>
</section>

<section class="about" id="about">
    <div class="container">
        <div class="about-content">
            <h2>Our Partners</h2>
            <div class="partners">
                @foreach($partners as $partner)
                    <div class="partner-logo">
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->name }}">
                            </a>
                        @else
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->name }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection