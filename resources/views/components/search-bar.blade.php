<div class="flex items-center pt-4 w-auto">
    <form method="GET" class="mb-4 flex gap-2">
    <input
        type="text"
        name="search"
        value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder ?? 'Search...' }}"
        class="border px-3 py-2 rounded w-full text-sm"
    >
    <button
        type="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded w-auto text-sm"
    >
        Search
    </button>
</form>

</div>