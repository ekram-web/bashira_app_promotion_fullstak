<div x-data="{ show: true }" x-show="show" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center justify-between" style="display: none;">
    <span>{{ $slot }}</span>
    <button @click="show = false; fetch('/admin/clear-notification')" class="ml-4 text-green-900 hover:text-green-700 font-bold text-xl leading-none">&times;</button>
</div> 