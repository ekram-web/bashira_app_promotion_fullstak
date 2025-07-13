<form method="{{ $method ?? 'POST' }}" action="{{ $action }}" {{ $attributes }} @if(!empty($hasFileUpload)) enctype="multipart/form-data" @endif>
    @csrf
    @if(isset($edit) && $edit)
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <strong class="block mb-2">There were some problems with your input:</strong>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="font-bold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ $slot }}

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        {{ $buttonText ?? ($edit ?? false ? 'Update' : 'Create') }}
    </button>
</form> 