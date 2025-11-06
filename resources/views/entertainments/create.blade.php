@extends('layouts.app')

@section('title', 'Add New Entertainment')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Add New Entertainment</h1>

    {{-- Form container --}}
    <div class="bg-white shadow-xl rounded-lg p-6 md:p-8">
        <form action="{{ route('entertainments.store') }}" method="POST">
            @csrf

            {{-- This `space-y-6` adds vertical spacing between form elements --}}
            <div class="space-y-6">

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('title')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- URL --}}
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" id="url"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="https://...">
                     @error('url')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="will_watch">Will Watch</option>
                        <option value="watching">Watching</option>
                        <option value="watched">Watched</option>
                    </select>
                     @error('status')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Form Buttons --}}
            <div class="flex justify-end space-x-4 mt-8">
                {{-- Gray "Cancel" button --}}
                <a href="{{ route('entertainments.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                   Cancel
                </a>

                {{-- Green "Save" button --}}
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                    Save
                </button>
            </div>

        </form>
    </div>
@endsection
