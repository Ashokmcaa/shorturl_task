<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <!-- Tailwind CSS CDN (Optional, can replace with Bootstrap) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="font-bold text-xl">Short URL Dashboard</a>

            @auth
                <div>
                    <span class="mr-4">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>

</html>
