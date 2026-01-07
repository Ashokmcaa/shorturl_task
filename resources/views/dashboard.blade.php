@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto mt-10">


        <div class="bg-white shadow-md rounded p-6 mb-6">
            <h1 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="text-gray-600">Role: {{ auth()->user()->role->name ?? 'N/A' }}</p>
            <p class="text-gray-600">Company: {{ auth()->user()->company->name ?? 'N/A' }}</p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


            <div class="bg-blue-500 text-white rounded p-6 shadow-md">
                <h2 class="text-xl font-semibold">Total Users</h2>
                <p class="text-3xl mt-2">{{ \App\Models\User::count() }}</p>
            </div>


            <div class="bg-green-500 text-white rounded p-6 shadow-md">
                <h2 class="text-xl font-semibold">Total Companies</h2>
                <p class="text-3xl mt-2">{{ \App\Models\Company::count() }}</p>
            </div>


            <div class="bg-yellow-500 text-white rounded p-6 shadow-md">
                <h2 class="text-xl font-semibold">Total Roles</h2>
                <p class="text-3xl mt-2">{{ \App\Models\Role::count() }}</p>
            </div>
        </div>


        <div class="mt-10 bg-white shadow-md rounded p-6">
            <h2 class="text-xl font-semibold mb-4">Recent Users</h2>
            <table class="w-full table-auto border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Company</th>
                        <th class="border px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\User::latest()->take(10)->get() as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->role->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $user->company->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
