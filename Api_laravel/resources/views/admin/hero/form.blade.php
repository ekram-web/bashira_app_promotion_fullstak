<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
<x-admin.form :action="$action" :edit="isset($hero)" :buttonText="$buttonText ?? null" :hasFileUpload="true">
    <div class="mb-4">
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $hero->title ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Subtitle</label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $hero->subtitle ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Background Gradient</label>
        <input type="text" name="background_gradient" value="{{ old('background_gradient', $hero->background_gradient ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Image</label>
        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        @if(isset($hero) && $hero->image)
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current image:</p>
                <img src="{{ asset('storage/' . $hero->image) }}" alt="Current hero image" class="mt-1 w-32 h-20 object-cover rounded">
            </div>
        @endif
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Order</label>
        <input type="number" name="order" value="{{ old('order', $hero->order ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4 flex items-center">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero->is_active ?? false) ? 'checked' : '' }} class="mr-2">
        <label class="font-medium">Active</label>
    </div>
</x-admin.form>
</div> 