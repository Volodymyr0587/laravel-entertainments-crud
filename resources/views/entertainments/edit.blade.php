@extends('layouts.app')

@section('title', 'Edit Entertainment')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit: {{ $entertainment->title }}</h1>

    <div class="bg-white shadow-xl rounded-lg p-6 md:p-8">
        <form action="{{ route('entertainments.update', $entertainment) }}" method="POST">
            @csrf
            @method('PUT') {{-- Important for "update" --}}

            <div class="space-y-6">

                {{-- Title --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $entertainment->title) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('title')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- URL --}}
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" id="url"
                           value="{{ old('url', $entertainment->url) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="https://...">
                    @error('url')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                        @foreach (App\Enums\EntertainmentStatus::cases() as $status)
                            <option value="{{ $status->value }}"
                                @selected(old('status', $entertainment->status->value ?? '') === $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tags --}}
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', $entertainment->tags->pluck('name')->implode(', ')) }}" placeholder="Tags (comma separated)"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('tags')
                        <span class="mt-2 text-xs font-bold text-red-500">{{ $message }}</span>
                    @enderror
                    <span class="mt-2 text-sm">Tags (comma separated): Action, Serial Killer, Horror</span>
                </div>
            </div>

            {{-- Form Buttons --}}
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('entertainments.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                   Cancel
                </a>

                {{-- Blue "Update" button --}}
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 cursor-pointer">
                    Update
                </button>
            </div>

        </form>
    </div>
@endsection
