@php
    $types = [
        'success' => [
            'border' => 'border-green-500',
            'text' => 'text-green-500',
            'title' => 'Success!',
            'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>',
        ],
        'error' => [
            'border' => 'border-red-500',
            'text' => 'text-red-500',
            'title' => 'Error!',
            'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 9h2v4H9V9zm0 6h2v2H9v-2z" clip-rule="evenodd"></path>',
        ],
        'warning' => [
            'border' => 'border-yellow-500',
            'text' => 'text-yellow-500',
            'title' => 'Warning!',
            'icon' => '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.721-1.36 3.486 0l6.518 11.595A1.5 1.5 0 0116.018 17H3.982a1.5 1.5 0 01-1.243-2.306L8.257 3.1zM11 13v2H9v-2h2zm0-6v4H9V7h2z" clip-rule="evenodd"></path>',
        ],
        'info' => [
            'border' => 'border-blue-500',
            'text' => 'text-blue-500',
            'title' => 'Info!',
            'icon' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-10.25a.75.75 0 10-1.5 0v.5a.75.75 0 001.5 0v-.5zm0 2.75a.75.75 0 00-1.5 0V14a.75.75 0 001.5 0v-3.5z" clip-rule="evenodd"></path>',
        ],
    ];

    $currentType = collect(['success', 'error', 'warning', 'info'])->first(fn($type) => session()->has($type));
@endphp

@if ($currentType)
    @php
        $message = session($currentType);
        $style = $types[$currentType];
    @endphp

    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 6000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-4"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-4"
        class="fixed bottom-6 right-6 z-50 flex items-start w-full max-w-sm p-4 text-gray-700 bg-white rounded-xl shadow-xl border-l-4 {{ $style['border'] }}"
        role="alert"
    >
        <div class="shrink-0 {{ $style['text'] }} pt-0.5">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                {!! $style['icon'] !!}
            </svg>
        </div>

        <div class="ml-3 text-sm font-medium grow">
            <p class="font-bold text-gray-800">{{ $style['title'] }}</p>
            <p class="text-gray-600">{{ $message }}</p>
        </div>

        <button
            @click="show = false"
            type="button"
            class="ml-4 -mr-1.5 -my-1.5 p-1.5 rounded-lg text-gray-400 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 inline-flex h-8 w-8"
            aria-label="Close"
        >
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif

