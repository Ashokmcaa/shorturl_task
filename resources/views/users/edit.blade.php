@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container mx-auto mt-6">

        <h1 class="text-2xl font-bold mb-4">Edit User</h1>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Edit Form --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white shadow-md p-6 rounded">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label class="block mb-1">Name</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- Role --}}
            <div class="mb-4">
                <label class="block mb-1">Role</label>
                <select name="role_id" class="w-full border px-3 py-2 rounded" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Company --}}
            <div class="mb-4">
                <label class="block mb-1">Company</label>
                <select name="company_id" class="w-full border px-3 py-2 rounded">
                    <option value="">Select Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $user->company_id == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Update User
            </button>

            <a href="{{ route('users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>

        </form>

    </div>
@endsection
