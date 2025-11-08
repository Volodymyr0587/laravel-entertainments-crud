@if (session()->has('success'))

<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
     x-transition
     class="fixed flex items-center gap-x-2 top-4 right-4 bg-green-400 text-white px-4 py-3 rounded-lg shadow-md transition duration-300">
    <p class="text-lg font-bold">
        {{ session('success') }}
    </p>
    <button @click="show = false"
        class="z-10 font-bold text-2xl text-gray-400 hover:text-gray-600 ml-4 hover:cursor-pointer">
        <span class="text-rose-500 dark:text-rose-300">x</span>
    </button>
</div>
@endif


