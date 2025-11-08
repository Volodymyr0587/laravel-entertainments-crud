{{-- This view extends the layout we just made --}}
@extends('layouts.app')

{{-- Set the title for this page --}}
@section('title', 'Trash')

@section('content')

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold mb-4">🗑️ Trashed Entertainments</h1>

        <div class="flex items-center gap-x-2">
            <a href="{{ route('entertainments.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                ← Back to List
            </a>
        </div>
    </div>

    <x-flash-message />


    @if ($trashed->count())
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deleted At</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashed as $entertainment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $entertainment->title }}</td>
                        <td class="px-6 py-4">{{ $entertainment->deleted_at->diffForHumans() }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('entertainments.restore', $entertainment->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800">Restore</button>
                            </form>
                            <form action="{{ route('entertainments.forceDelete', $entertainment->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-3">Delete Forever</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $trashed->links() }}
    </div>
    @else
        <p class="text-gray-500">No trashed entertainments found.</p>
    @endif

@endsection
