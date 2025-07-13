<form method="POST" action="{{ $action }}">
    @csrf
    @if(isset($offer))
        @method('PUT')
    @endif
    <div class="mb-4">
        <label class="block font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $offer->title ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Subtitle</label>
        <input type="text" name="subtitle" value="{{ old('subtitle', $offer->subtitle ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Description</label>
        <textarea name="description" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $offer->description ?? '') }}</textarea>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Section Title (for main section)</label>
        <input type="text" name="section_title" value="{{ old('section_title', $offer->section_title ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Section Description (for main section)</label>
        <textarea name="section_description" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('section_description', $offer->section_description ?? '') }}</textarea>
    </div>
    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition font-semibold">{{ $buttonText ?? (isset($offer) ? 'Update' : 'Create') }}</button>
</form> 