@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div class="container mx-auto mt-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Users List</h1>
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Add User
            </a>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Users Table --}}
        <div class="bg-white shadow-md rounded overflow-x-auto">
            <table class="w-full table-auto border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Name</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Company</th>
                        <th class="border px-4 py-2">Created At</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{ $user->email }}</td>
                            <td class="border px-4 py-2">{{ $user->role->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $user->company->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $user->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2 flex gap-2">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="bg-yellow-400 px-2 py-1 rounded text-white hover:bg-yellow-500">
                                    Edit
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-2 py-1 rounded text-white hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center p-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination (if using paginate()) --}}
        <div class="mt-4">
            {{ $users->links() }}
        </div>

    </div>
@endsection
