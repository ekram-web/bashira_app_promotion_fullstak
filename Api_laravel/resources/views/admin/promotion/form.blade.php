<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
<x-admin.form :action="$action" :edit="isset($promotion)" :buttonText="$buttonText ?? null" :hasFileUpload="true">
    <div class="mb-4">
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $promotion->title ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Subtitle</label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $promotion->subtitle ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">App Store URL</label>
        <input type="text" name="app_store_url" value="{{ old('app_store_url', $promotion->app_store_url ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Play Store URL</label>
        <input type="text" name="play_store_url" value="{{ old('play_store_url', $promotion->play_store_url ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">QR Code Image</label>
        <input type="file" name="qr_code_image" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        @if(isset($promotion) && $promotion->qr_code_image)
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current QR code image:</p>
                <img src="{{ asset('storage/' . $promotion->qr_code_image) }}" alt="Current QR code image" class="mt-1 w-32 h-20 object-cover rounded">
            </div>
        @endif
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Phone Image</label>
        <input type="file" name="phone_image" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        @if(isset($promotion) && $promotion->phone_image)
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current phone image:</p>
                <img src="{{ asset('storage/' . $promotion->phone_image) }}" alt="Current phone image" class="mt-1 w-32 h-20 object-cover rounded">
            </div>
        @endif
    </div>
    <div class="mb-4 flex items-center">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $promotion->is_active ?? false) ? 'checked' : '' }} class="mr-2">
        <label class="font-medium">Active</label>
    </div>
</x-admin.form>
</div> 