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
                <x-svg.export />
                Export
            </x-export-modal>

            <a href="{{ route('entertainments.trash') }}"
                class="relative inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white font-bold py-2 px-4
                    rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105">
                <x-svg.trash />
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
                            <a href="{{ $entertainment->url }}" target="_blank"  class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-400 border border-indigo-400/30 rounded-full hover:bg-indigo-500/10 hover:border-indigo-400/50 transition-colors duration-200">
                                Visit Resource
                                <x-svg.external-link />
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
