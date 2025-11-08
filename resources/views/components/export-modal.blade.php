@props([
    'route',
    'title' => 'Export',
    'extensions' => [
        '' => ['label' => 'No extension', 'description' => 'Linux/Unix style'],
        'txt' => ['label' => 'Text file (.txt)', 'description' => 'Standard text document'],
        'log' => ['label' => 'Log file (.log)', 'description' => 'For logging purposes'],
    ]
])

<div x-data="{ open: false, extension: '' }">
    <!-- Trigger -->
    <button
        @click="open = true"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 hover:cursor-pointer transition duration-200 ease-in-out transform hover:scale-105']) }}
    >
        {{ $slot }}
    </button>

    <!-- Modal -->
    <div
        x-show="open"
        x-cloak
        @click.self="open = false"
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-lg font-semibold">{{ $title }}</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <fieldset>
                    <legend class="text-sm font-medium text-gray-700 mb-3">Select file format</legend>
                    <div class="space-y-3">
                        @foreach($extensions as $value => $data)
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition"
                               :class="extension === '{{ $value }}' ? 'border-blue-500 bg-blue-50' : 'border-gray-300'">
                            <input
                                type="radio"
                                name="extension"
                                value="{{ $value }}"
                                x-model="extension"
                                class="w-4 h-4 text-blue-600"
                            >
                            <div class="ml-3">
                                <span class="block text-sm font-medium text-gray-900">{{ $data['label'] }}</span>
                                <span class="block text-xs text-gray-500">{{ $data['description'] }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </fieldset>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 border-t bg-gray-50">
                <button
                    @click="open = false"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-md hover:bg-gray-50 cursor-pointer"
                >
                    Cancel
                </button>
                <a
                    :href="extension ? '{{ $route }}?ext=' + extension : '{{ $route }}'"
                    @click="open = false"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700"
                >
                    Download
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
