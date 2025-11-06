{{-- This view extends the layout we just made --}}
@extends('layouts.app')

{{-- Set the title for this page --}}
@section('title', 'All Entertainments')

@section('content')

    {{-- 1. Header: Title and "Add New" Button --}}
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Entertainments</h1>

        {{-- Green "Create" button --}}
        <a href="{{ route('entertainments.create') }}"
           class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
            + Add New
        </a>
    </div>

    {{-- 2. The Table --}}
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @foreach ($entertainments as $entertainment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $entertainment->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Status "Badge" --}}
                        @if ($entertainment->status == 'watched')
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Watched
                            </span>
                        @elseif ($entertainment->status == 'watching')
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Watching
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Will Watch
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($entertainment->url)
                            <a href="{{ $entertainment->url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                Link
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                        <a href="{{ route('entertainments.show', $entertainment) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        <a href="{{ route('entertainments.edit', $entertainment) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                        <form action="{{ route('entertainments.destroy', $entertainment) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            {{-- Red "Delete" button --}}
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
