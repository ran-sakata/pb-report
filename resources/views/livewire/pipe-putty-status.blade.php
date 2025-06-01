<div class="inline-flex w-full divide-x divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800 rounded-md" role="group">
    <button type="button"
        wire:click="setStatus('〇')"
        class="flex-1 px-4 py-2 flex flex-row items-center justify-center rounded-md rounded-r-none text-sm font-medium
            {{ $status === '〇'
                ? 'bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-200'
                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-900 hover:text-indigo-700 dark:hover:text-indigo-200' }}">
        <!-- Heroicon: CheckCircle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <circle cx="12" cy="12" r="10" stroke-width="2" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" />
        </svg>
    </button>
    <button type="button"
        wire:click="setStatus('△')"
        class="flex-1 px-4 py-2 flex flex-row items-center justify-center text-sm font-medium
            {{ $status === '△'
                ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-200'
                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-yellow-100 dark:hover:bg-yellow-900 hover:text-yellow-700 dark:hover:text-yellow-200' }}">
        <!-- Heroicon: Exclamation -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <polygon points="12,4 20,20 4,20" stroke-width="2" stroke-linejoin="round" />
            <line x1="12" y1="9" x2="12" y2="13" stroke-width="2" stroke-linecap="round"/>
            <circle cx="12" cy="16" r="1" />
        </svg>
    </button>
    <button type="button"
        wire:click="setStatus('×')"
        class="flex-1 px-4 py-2 flex flex-row items-center justify-center rounded-md rounded-l-none text-sm font-medium
            {{ $status === '×'
                ? 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200'
                : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-red-100 dark:hover:bg-red-900 hover:text-red-700 dark:hover:text-red-200' }}">
        <!-- Heroicon: XCircle -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <circle cx="12" cy="12" r="10" stroke-width="2" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6m0-6l6 6" />
        </svg>
    </button>
</div>
