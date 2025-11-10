{{-- This view extends the layout we just made --}}
@extends('layouts.app')

{{-- Set the title for this page --}}
@section('title', 'All Entertainments')

@section('content')

    {{-- 1. Header: Title and "Add New" Button --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Entertainments</h1>

        <div class="flex items-center gap-x-2">
            <a href="{{ route('entertainments.create') }}"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4
                rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                + Add New
            </a>

            <x-export-modal :route="route('entertainments.export')" title="Export Entertainments" class="font-bold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export
            </x-export-modal>

            <a href="{{ route('entertainments.trash') }}"
                class="relative inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2 px-4
                    rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                <svg class="w-5 h-5" viewBox="-3 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>trash</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-259.000000, -203.000000)" fill="#ffffff"> <path d="M282,211 L262,211 C261.448,211 261,210.553 261,210 C261,209.448 261.448,209 262,209 L282,209 C282.552,209 283,209.448 283,210 C283,210.553 282.552,211 282,211 L282,211 Z M281,231 C281,232.104 280.104,233 279,233 L265,233 C263.896,233 263,232.104 263,231 L263,213 L281,213 L281,231 L281,231 Z M269,206 C269,205.447 269.448,205 270,205 L274,205 C274.552,205 275,205.447 275,206 L275,207 L269,207 L269,206 L269,206 Z M283,207 L277,207 L277,205 C277,203.896 276.104,203 275,203 L269,203 C267.896,203 267,203.896 267,205 L267,207 L261,207 C259.896,207 259,207.896 259,209 L259,211 C259,212.104 259.896,213 261,213 L261,231 C261,233.209 262.791,235 265,235 L279,235 C281.209,235 283,233.209 283,231 L283,213 C284.104,213 285,212.104 285,211 L285,209 C285,207.896 284.104,207 283,207 L283,207 Z M272,231 C272.552,231 273,230.553 273,230 L273,218 C273,217.448 272.552,217 272,217 C271.448,217 271,217.448 271,218 L271,230 C271,230.553 271.448,231 272,231 L272,231 Z M267,231 C267.552,231 268,230.553 268,230 L268,218 C268,217.448 267.552,217 267,217 C266.448,217 266,217.448 266,218 L266,230 C266,230.553 266.448,231 267,231 L267,231 Z M277,231 C277.552,231 278,230.553 278,230 L278,218 C278,217.448 277.552,217 277,217 C276.448,217 276,217.448 276,218 L276,230 C276,230.553 276.448,231 277,231 L277,231 Z" id="trash" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                Trash
                @if ($countInTrash)
                    <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 inline-flex items-center justify-center h-5 w-5
                        rounded-full bg-yellow-400 text-xs font-bold text-gray-900 ring-2 ring-white">
                        {{ $countInTrash }}
                    </span>
                @endif
            </a>
        </div>
    </div>

    <x-flash-message />

    <div class="my-4">
        {{-- Search Form --}}
        <form action="{{ route('entertainments.index') }}" method="GET" class="flex space-x-2 items-center">
            {{-- Search Input --}}
            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Search by title..."
                class="grow px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">

            {{-- Status Dropdown (auto-submit on change) --}}
            <select name="status"
                    class="px-3 py-2 border rounded-md cursor-pointer"
                    onchange="this.form.submit()">
                <option value="">All statuses</option>
                @foreach (App\Enums\EntertainmentStatus::cases() as $statusOption)
                    <option value="{{ $statusOption->value }}"
                        @selected(request('status') === $statusOption->value)>
                        {{ $statusOption->label() }}
                    </option>
                @endforeach
            </select>

            {{-- Optional submit button for mobile users or when JS disabled --}}
            <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 cursor-pointer
                    rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                Filter
            </button>

            {{-- Reset Button --}}
            @if (request('search') || request('status') || request('tag'))
                <a href="{{ route('entertainments.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4
                rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                    Reset
                </a>
            @endif
        </form>
    </div>

    @if ($searchTerm)
    <div class="my-2 text-xl font-bold text-gray-800">
        Search result for <span class="text-orange-500">{{ $searchTerm ?? "" }}</span>
    </div>
    @endif

    {{-- 2. The Table --}}
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium
                        {{ request('sort') ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-500' }} uppercase tracking-wider">
                        <a href="{{ route('entertainments.index', array_merge(request()->query(), [
                            'sort' => request('sort') === 'asc' ? 'desc' : 'asc',
                        ])) }}" class="flex items-center space-x-1">
                            <span>Title</span>
                            @if (request('sort') === 'asc')
                                <span>▲</span>
                            @elseif (request('sort') === 'desc')
                                <span>▼</span>
                            @else
                                <span>▲▼</span>
                            @endif
                        </a>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tags</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @foreach ($entertainments as $entertainment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap max-w-sm">
                        <div class="text-sm font-medium text-gray-900 truncate">{{ $entertainment->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Status "Badge" --}}
                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium inset-ring
                            {{ $entertainment->status === App\Enums\EntertainmentStatus::Watched ? 'bg-green-400/10 text-green-400 inset-ring-green-500/20' : '' }}
                            {{ $entertainment->status === App\Enums\EntertainmentStatus::Watching ? 'bg-blue-400/10 text-blue-400 inset-ring-blue-500/20' : '' }}
                            {{ $entertainment->status === App\Enums\EntertainmentStatus::OnHold ? 'bg-yellow-400/10 text-yellow-400 inset-ring-yellow-500/20' : '' }}
                            {{ $entertainment->status === App\Enums\EntertainmentStatus::WillWatch ? 'bg-purple-400/10 text-purple-400 inset-ring-purple-500/20' : '' }}
                            {{ $entertainment->status === App\Enums\EntertainmentStatus::Abandoned ? 'bg-red-400/10 text-red-400 inset-ring-red-500/20' : '' }}">

                            <a href="{{ route('entertainments.index', ['status' => $entertainment->status]) }}" >
                                {{ $entertainment->status->label() }}
                            </a>
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($entertainment->tags as $tag)
                            <a href="{{ route('entertainments.index', ['tag' => $tag->name]) }}"
                            class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 inset-ring inset-ring-purple-700/10">
                            {{ $tag->name }}
                            </a>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($entertainment->url)
                            <a href="{{ $entertainment->url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 px-3 py-0.5 border border-amber-600 rounded-full text-sm hover:bg-amber-300">
                                Link
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                        @can('view', $entertainment)
                        <a href="{{ route('entertainments.show', $entertainment) }}" class="text-blue-600 hover:text-blue-900">View</a>
                        @endcan

                        @can('update', $entertainment)
                        <a href="{{ route('entertainments.edit', $entertainment) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                        @endcan

                        @can('delete', $entertainment)
                        <form action="{{ route('entertainments.destroy', $entertainment) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            {{-- Red "Delete" button --}}
                            <button type="submit" class="text-red-600 hover:text-red-900 cursor-pointer" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div>
        {{ $entertainments->links() }}
    </div>

@endsection
