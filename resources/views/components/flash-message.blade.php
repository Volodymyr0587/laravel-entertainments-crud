@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 6000)" x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-4"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-4"
        class="fixed bottom-6 right-6 z-50 flex items-start w-full max-w-sm p-4 text-gray-700 bg-white rounded-xl shadow-xl border-l-4 border-green-500"
        role="alert">

        <div class="shrink-0 text-green-500 pt-0.5">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>

        <div class="ml-3 text-sm font-medium grow">
            <p class="font-bold text-gray-800">Success!</p>
            <p class="text-gray-600">
                {{ session('success') }}
            </p>
        </div>

        <button @click="show = false"
                type="button"
                class="ml-4 -mr-1.5 -my-1.5 p-1.5 rounded-lg text-gray-400 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 inline-flex h-8 w-8"
                aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
@endif


