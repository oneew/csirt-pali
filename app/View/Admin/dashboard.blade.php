@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users text-3xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['users'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-3xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Services</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['services'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-images text-3xl text-purple-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Gallery Items</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['gallery_items'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-handshake text-3xl text-yellow-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Partners</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['partners'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-envelope text-3xl text-red-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Unread Contacts</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['unread_contacts'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-chart-bar text-3xl text-indigo-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Contacts</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total_contacts'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Contacts -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Contacts</h3>
            <div class="space-y-4">
                @forelse($recentContacts as $contact)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $contact->name }}</p>
                            <p class="text-sm text-gray-500">{{ $contact->subject }}</p>
                            <p class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($contact->status === 'unread') bg-red-100 text-red-800
                                @elseif($contact->status === 'read') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($contact->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No contacts yet.</p>
                @endforelse
            </div>
            @if($recentContacts->count() > 0)
                <div class="mt-4">
                    <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:text-blue-800">
                        View all contacts →
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Recent Users</h3>
            <div class="space-y-4">
                @forelse($recentUsers as $user)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <p class="text-xs text-gray-400">
                                Registered {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div>
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($user->role === 'admin') bg-purple-100 text-purple-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No users yet.</p>
                @endforelse
            </div>
            @if($recentUsers->count() > 0)
                <div class="mt-4">
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">
                        View all users →
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
