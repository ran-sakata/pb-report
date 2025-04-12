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

        <form action="{{ route('forth-page.update', ['report' => $report->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @for ($i = 1; $i <= 3; $i++)
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">特記事項{{ $i }}</h2>
                    <div class="mb-4">
                        <label for="special_note_title_{{ $i }}" class="block text-base font-medium text-gray-700 dark:text-gray-300">タイトル</label>
                        <input type="text" id="special_note_title_{{ $i }}" name="special_note_title_{{ $i }}" value="{{ old("special_note_title_{$i}", $report->specialNotes->firstWhere('index', $i)->title ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="mb-4">
                        <label for="special_note_photo_{{ $i }}" class="block text-base font-medium text-gray-700 dark:text-gray-300">写真</label>
                        <input type="file" id="special_note_photo_{{ $i }}" name="special_note_photo_{{ $i }}" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="special_note_photo_{{ $i }}_preview">
                        <div id="special_note_photo_{{ $i }}_preview" class="preview-container mt-2">
                            @if ($photo = $report->specialNotes->firstWhere('index', $i))
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="特記事項{{ $i }}の写真" class="h-32 object-contain rounded-md">
                            @endif
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="special_note_description_{{ $i }}" class="block text-base font-medium text-gray-700 dark:text-gray-300">説明</label>
                        <textarea id="special_note_description_{{ $i }}" name="special_note_description_{{ $i }}" rows="3" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old("special_note_description_{$i}", $report->specialNotes->firstWhere('index', $i)->description ?? '') }}</textarea>
                    </div>
                </div>
            @endfor

            <!-- 備考欄 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">備考</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">その他気になるところあれば</p>
                <div class="mb-4">
                    <textarea id="remarks" name="remarks" rows="3" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('remarks', $report->remarks) }}</textarea>
                    @error('remarks')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <div class="flex justify-between">
                    <a href="{{ route('third-page',['report' => $report->id]) }}" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                        前へ
                    </a>
                    <button type="submit" id="loading-button" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        内容を確認
                    </button>
                </div>
            </div>

            <div>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('welcome') }}" class="w-full text-gray-700 dark:text-gray-300 py-2 px-4 rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center">
                        はじめに戻る
                    </a>
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
