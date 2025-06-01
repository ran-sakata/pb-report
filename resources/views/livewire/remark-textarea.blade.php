<div class="mb-4">
<textarea
    id="remarks"
    wire:model.lazy="remarks"
    rows="3"
    class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
></textarea>
@error('remarks')
    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
@enderror
</div>
