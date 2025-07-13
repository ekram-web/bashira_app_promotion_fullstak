
{{-- TEST: This is the reviews form file --}}

<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
<x-admin.form :action="$action" :edit="isset($review)" :buttonText="$buttonText ?? null" :hasFileUpload="true">
    <div class="mb-4">
        <label class="block font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $review->name ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Role</label>
        <input type="text" name="role" value="{{ old('role', $review->role ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Text</label>
        <textarea name="text" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('text', $review->text ?? '') }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Image</label>
        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        @if(isset($review) && $review->image)
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current image:</p>
                <img src="{{ asset('storage/' . $review->image) }}" alt="Current review image" class="mt-1 w-32 h-20 object-cover rounded">
            </div>
        @endif
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Rating</label>
        <input type="number" name="rating" value="{{ old('rating', $review->rating ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Order</label>
        <input type="number" name="order" value="{{ old('order', $review->order ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4 flex items-center">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $review->is_active ?? false) ? 'checked' : '' }} class="mr-2">
        <label class="font-medium">Active</label>
    </div>
</x-admin.form>
</div> 