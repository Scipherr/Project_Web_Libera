<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-red-800 border-b border-red-700 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="font-bold text-xl">Admin Panel</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="text-gray-200 hover:text-white text-sm">Return to Site</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-bold mb-4">Welcome, Admin</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <h3 class="text-lg font-semibold text-blue-800">Total Users</h3>
                                <p class="text-3xl font-bold text-blue-900 mt-2">{{ \App\Models\User::count() }}</p>
                            </div>
                            
                            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                                <h3 class="text-lg font-semibold text-indigo-800">Total Posts</h3>
                                <p class="text-3xl font-bold text-indigo-900 mt-2">{{ \App\Models\Post::count() }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 flex items-center justify-center">
                                <button class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                                    Manage Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>