<div>
    <form method="GET" class="mb-4 flex gap-2">
    <input
        type="text"
        name="search"
        value="<?php echo e($value ?? ''); ?>"
        placeholder="<?php echo e($placeholder ?? 'Search...'); ?>"
        class="border px-3 py-2 rounded <?php echo e($width ?? 'w-1/3'); ?>"
    >
    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded"
    >
        Search
    </button>
</form>

</div><?php /**PATH D:\xampp\htdocs\lcms\resources\views/components/search-bar.blade.php ENDPATH**/ ?>