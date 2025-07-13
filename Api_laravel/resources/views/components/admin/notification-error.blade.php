<div x-data="{ show: true }" x-show="show" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex items-center justify-between" style="display: none;">
    <span>{{ $slot }}</span>
    <button @click="show = false; fetch('/admin/clear-error')" class="ml-4 text-red-900 hover:text-red-700 font-bold text-xl leading-none">&times;</button>
</div> 