<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
<x-admin.form :action="$action" :edit="isset($contact)" :buttonText="$buttonText ?? null">
    <div class="mb-4">
        <label class="block font-medium mb-1">Address</label>
        <input type="text" name="address" value="{{ old('address', $contact->address ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $contact->phone ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $contact->email ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Website</label>
        <input type="text" name="website" value="{{ old('website', $contact->website ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
    <div class="mb-4">
        <label class="block font-medium mb-1">Map Embed URL</label>
        <input type="text" name="map_embed_url" value="{{ old('map_embed_url', $contact->map_embed_url ?? '') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>
</x-admin.form>
</div> 