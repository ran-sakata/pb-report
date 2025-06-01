<div class="mb-4">
    <form wire:submit.prevent="save" enctype="multipart/form-data"
        x-data="{
            progress: 0,
            isDragging: false,
            showInput: {{ ($row_photo || ($report->rowPhotos->firstWhere('row_number', $rowNumber)?->photo_path)) ? 'false' : 'true' }},
            removeImage() { this.showInput = true; }
        }"
        x-on:livewire-upload-start="progress = 0"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
        x-on:livewire-upload-finish="progress = 0; showInput = false;"
        x-on:livewire-upload-error="progress = 0"
    >
        <label class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">列{{ $rowNumber }}</label>
        <template x-if="showInput">
            <div
                class="w-full border-3 border-dashed rounded-2xl p-8 text-center cursor-pointer transition duration-200 flex flex-col sm:items-center sm:justify-center gap-2 relative"
                :class="isDragging ? 'border-indigo-600 bg-indigo-100 dark:bg-indigo-900' : 'border-gray-400 dark:border-gray-500 bg-white dark:bg-gray-800'"
                x-on:click="$refs.fileInput.click()"
                x-on:dragover.prevent="isDragging = true"
                x-on:dragleave.prevent="isDragging = false"
                x-on:drop.prevent="
                    isDragging = false;
                    if ($event.dataTransfer.files.length) {
                        $refs.fileInput.files = $event.dataTransfer.files;
                        $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                "
            >
                <span class="text-gray-700 dark:text-gray-300 font-semibold">
                    ここにファイルをドラッグ＆ドロップ
                </span>
                <span class="text-gray-500 dark:text-gray-400 text-sm">
                    または
                </span>
                <button type="button"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded shadow focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    x-on:click.stop="$refs.fileInput.click()"
                >
                    ファイルを選択
                </button>
                <input
                    type="file"
                    wire:model="row_photo"
                    wire:change="save"
                    class="hidden"
                    x-ref="fileInput"
                />
            </div>
        </template>

        @error('row_photo') <span class="text-red-500">{{ $message }}</span> @enderror

        <div class="mt-2" x-show="progress > 0">
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-600">
                <div class="bg-indigo-600 h-2.5 rounded-full" :style="'width: ' + progress + '%'"></div>
            </div>
            <div class="text-xs text-gray-600 mt-1" x-text="progress + '%'"></div>
        </div>

        <template x-if="!showInput">
            <div class="relative flex flex-col items-center">
                @if ($row_photo)
                    <img src="{{ $row_photo->temporaryUrl() }}" class="h-32 object-contain rounded-2xl border border-gray-300 dark:border-gray-600 bg-white" />
                @else
                    @php
                        $photo = $report->rowPhotos->firstWhere('row_number', $rowNumber);
                    @endphp
                    @if ($photo)
                        @if ($photo->thumbnail_path)
                            <img src="{{ asset('storage/' . $photo->thumbnail_path) . '?' . ($photo->updated_at?->timestamp ?? now()->timestamp) }}" class="h-32 object-contain rounded-2xl border border-gray-300 dark:border-gray-600 bg-white" />
                        @else
                            <img src="{{ asset('storage/' . $photo->photo_path) . '?' . ($photo->updated_at?->timestamp ?? now()->timestamp) }}" class="h-32 object-contain rounded-2xl border border-gray-300 dark:border-gray-600 bg-white" />
                        @endif
                    @endif
                @endif
                <button type="button"
                    class="absolute top-2 right-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-500 rounded-full w-8 h-8 flex items-center justify-center shadow hover:bg-red-100 dark:hover:bg-red-900"
                    x-on:click="removeImage()"
                    wire:click="deleteRowPhoto"
                    style="z-index:10;"
                >
                    <span class="text-gray-600 dark:text-gray-300 text-xl">&times;</span>
                </button>
            </div>
        </template>

        <button type="submit" x-ref="submitBtn" class="mt-2 bg-indigo-600 text-white py-1 px-4 rounded hover:bg-indigo-700 hidden">アップロード</button>
    </form>
</div>
