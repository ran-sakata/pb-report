<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>その他 | 報告書作成フォーム</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1">
                <div class="h-2 bg-indigo-600 rounded-full" style="width: 100%;"></div>
            </div>
            <div class="flex space-x-2 text-sm text-gray-500 dark:text-gray-400 ml-4">
                <span>4 / 4</span>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">その他</h1>

        @if (session('message'))
        <div id="flash-message" class="fixed bottom-15 right-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <form action="/{{ $report->id }}/forth-page" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <!-- 特記事項1 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">特記事項1</h2>
                <div class="mb-4">
                    <label for="special_note_title_1" class="block text-base font-medium text-gray-700 dark:text-gray-300">タイトル</label>
                    <input type="text" id="special_note_title_1" name="special_note_title_1" value="{{ old('special_note_title_1', $report->special_note_title_1) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('special_note_title_1')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="special_note_photo_1" class="block text-base font-medium text-gray-700 dark:text-gray-300">写真</label>
                    <input type="file" id="special_note_photo_1" name="special_note_photo_1" accept="image/*" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <img id="special_note_photo_1_preview" class="mt-2 max-h-40 rounded-md" style="display: {{ $report->special_note_photo_1 ? 'block' : 'none' }};" src="{{ $report->special_note_photo_1 ? asset('storage/' . $report->special_note_photo_1) : '' }}" />
                    @if ($report->special_note_photo_1)
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_special_note_photo_1" value="1" class="form-checkbox text-red-600 dark:text-red-400">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">この写真を削除する</span>
                            </label>
                        </div>
                    @endif
                    @error('special_note_photo_1')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="special_note_description_1" class="block text-base font-medium text-gray-700 dark:text-gray-300">説明</label>
                    <textarea id="special_note_description_1" name="special_note_description_1" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ old('special_note_description_1', $report->special_note_description_1) }}</textarea>
                    @error('special_note_description_1')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 特記事項2 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">特記事項2</h2>
                <div class="mb-4">
                    <label for="special_note_title_2" class="block text-base font-medium text-gray-700 dark:text-gray-300">タイトル</label>
                    <input type="text" id="special_note_title_2" name="special_note_title_2" value="{{ old('special_note_title_2', $report->special_note_title_2) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('special_note_title_2')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="special_note_photo_2" class="block text-base font-medium text-gray-700 dark:text-gray-300">写真</label>
                    <input type="file" id="special_note_photo_2" name="special_note_photo_2" accept="image/*" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <img id="special_note_photo_2_preview" class="mt-2 max-h-40 rounded-md" style="display: {{ $report->special_note_photo_2 ? 'block' : 'none' }};" src="{{ $report->special_note_photo_2 ? asset('storage/' . $report->special_note_photo_2) : '' }}" />
                    @if ($report->special_note_photo_2)
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_special_note_photo_2" value="1" class="form-checkbox text-red-600 dark:text-red-400">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">この写真を削除する</span>
                            </label>
                        </div>
                    @endif
                    @error('special_note_photo_2')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="special_note_description_2" class="block text-base font-medium text-gray-700 dark:text-gray-300">説明</label>
                    <textarea id="special_note_description_2" name="special_note_description_2" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ old('special_note_description_2', $report->special_note_description_2) }}</textarea>
                    @error('special_note_description_2')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 特記事項3 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">特記事項3</h2>
                <div class="mb-4">
                    <label for="special_note_title_3" class="block text-base font-medium text-gray-700 dark:text-gray-300">タイトル</label>
                    <input type="text" id="special_note_title_3" name="special_note_title_3" value="{{ old('special_note_title_3', $report->special_note_title_3) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('special_note_title_3')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="special_note_photo_3" class="block text-base font-medium text-gray-700 dark:text-gray-300">写真</label>
                    <input type="file" id="special_note_photo_3" name="special_note_photo_3" accept="image/*" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <img id="special_note_photo_3_preview" class="mt-2 max-h-40 rounded-md" style="display: {{ $report->special_note_photo_3 ? 'block' : 'none' }};" src="{{ $report->special_note_photo_3 ? asset('storage/' . $report->special_note_photo_3) : '' }}" />
                    @if ($report->special_note_photo_3)
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_special_note_photo_3" value="1" class="form-checkbox text-red-600 dark:text-red-400">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">この写真を削除する</span>
                            </label>
                        </div>
                    @endif
                    @error('special_note_photo_3')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="special_note_description_3" class="block text-base font-medium text-gray-700 dark:text-gray-300">説明</label>
                    <textarea id="special_note_description_3" name="special_note_description_3" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ old('special_note_description_3', $report->special_note_description_3) }}</textarea>
                    @error('special_note_description_3')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- 備考欄 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">備考</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">その他気になるところあれば</p>
                <div class="mb-4">
                    <textarea id="remarks" name="remarks" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">{{ old('remarks', $report->remarks) }}</textarea>
                    @error('remarks')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <div class="flex justify-between">
                    <a href="/{{ $report->id }}/third-page" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                        前へ
                    </a>
                    <button type="submit" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        内容を確認
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="fixed bottom-4 right-4">
        <button id="scroll-to-bottom" class="bg-blue-600 text-white py-2 px-4 rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            ↓
        </button>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
