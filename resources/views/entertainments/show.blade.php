@extends('layouts.app')

@section('title', $entertainment->title)

@section('content')

    <div class="bg-white shadow-xl rounded-lg p-6 md:p-8">
        {{-- Header: Title and Status Badge --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start mb-4">
            <h1 class="text-3xl font-bold text-gray-900 mb-2 sm:mb-0">
                {{ $entertainment->title }}
            </h1>

            {{-- Status "Badge" --}}
            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium
                {{ $entertainment->status === App\Enums\EntertainmentStatus::Watched ? 'bg-green-100 text-green-800' : '' }}
                {{ $entertainment->status === App\Enums\EntertainmentStatus::Watching ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $entertainment->status === App\Enums\EntertainmentStatus::OnHold ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $entertainment->status === App\Enums\EntertainmentStatus::WillWatch ? 'bg-gray-100 text-gray-800' : '' }}">

                {{ $entertainment->status->label() }}
            </span>
        </div>

        <div class="my-4">
            @foreach ($entertainment->tags as $tag)
                <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 inset-ring inset-ring-purple-700/10">
                {{ $tag->name }}
                </span>
            @endforeach
        </div>

        <hr class="my-6">

        {{-- Details --}}
        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-800">Details</h3>

            @if ($entertainment->url)
                <div class="text-sm">
                    <span class="font-medium text-gray-600">URL:</span>
                    <a href="{{ $entertainment->url }}" target="_blank"
                       class="text-indigo-600 hover:text-indigo-900 break-all">
                        {{ $entertainment->url }}
                    </a>
                </div>
            @endif

            <div class="text-sm">
                <span class="font-medium text-gray-600">Added:</span>
                <span class="text-gray-700">{{ $entertainment->created_at->format('M d, Y') }}</span>
            </div>
             <div class="text-sm">
                <span class="font-medium text-gray-600">Last Updated:</span>
                <span class="text-gray-700">{{ $entertainment->updated_at->format('M d, Y') }}</span>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex justify-end space-x-4 mt-8">
            <a href="{{ route('entertainments.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
               Back to List
            </a>

            {{-- Yellow "Edit" button --}}
            <a href="{{ route('entertainments.edit', $entertainment) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
               Edit
            </a>
        </div>
    </div>
@endsection
