<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
<x-admin.form :action="$action" :edit="isset($about)" :buttonText="$buttonText ?? null" :hasFileUpload="true">
    <div class="mb-4">
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $about->title ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Description</label>
        <textarea name="description" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>{{ old('description', $about->description ?? '') }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Mission</label>
        <input type="text" name="mission" value="{{ old('mission', $about->mission ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Vision</label>
        <input type="text" name="vision" value="{{ old('vision', $about->vision ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Image</label>
        <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        @if(isset($about) && $about->image)
            <div class="mt-2">
                <p class="text-sm text-gray-600">Current image:</p>
                <img src="{{ asset('storage/' . $about->image) }}" alt="Current about image" class="mt-1 w-32 h-20 object-cover rounded">
            </div>
        @endif
    </div>
</x-admin.form>
</div> 