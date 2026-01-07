@extends('layouts.app')

@section('title', 'Create Short URL')

@section('content')
    <div class="container mx-auto mt-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Create Short URL</h1>
            <a href="{{ route('short_urls.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back to List
            </a>
        </div>


        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ route('short_urls.store') }}" method="POST" class="bg-white shadow-md p-6 rounded">
            @csrf


            <div class="mb-4">
                <label class="block mb-1 font-semibold">Original URL</label>
                <input type="url" name="original_url" placeholder="https://example.com/long-url"
                    class="w-full border px-3 py-2 rounded" value="{{ old('original_url') }}" required>
            </div>


            {{-- <div class="mb-4">
                <label class="block mb-1 font-semibold">Custom Slug (Optional)</label>
                <input type="text" name="slug" placeholder="your-custom-slug" class="w-full border px-3 py-2 rounded"
                    value="{{ old('slug') }}">
                <p class="text-gray-500 text-sm mt-1">Leave blank to auto-generate a short code.</p>
            </div> --}}

            {{-- Submit Button --}}
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create Short URL
            </button>
        </form>

    </div>
@endsection
