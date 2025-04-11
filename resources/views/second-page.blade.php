<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>除草剤散布 | 報告書作成フォーム</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1">
                <div class="h-2 bg-indigo-600 rounded-full" style="width: 50%;"></div>
            </div>
            <div class="flex space-x-2 text-sm text-gray-500 dark:text-gray-400 ml-4">
                <span>2 / 4</span>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">除草剤散布</h1>

        @if (session('message'))
            <div id="flash-message" class="fixed bottom-15 right-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('second-page.update', [ 'report' => $report->id ]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 看板写真 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow mb-4">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">看板写真</h2>
                <div class="relative">
                    <input type="file" id="signboard_photo_path" name="signboard_photo_path" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="signboard_preview">
                    <div id="signboard_preview" class="preview-container">
                        @if (isset($report->signboard_photo_path))
                            <img src="{{ asset('storage/' . $report->signboard_photo_path) }}" alt="プレビュー画像" class="h-32 objectfit-contain rounded-md mt-2">
                        @endif
                    </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像（最大10MB）をアップロードしてください。</p>
            </div>

            <!-- 南から1~10列目 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">南から1~10列目</h2>
                @for ($i = 1; $i <= 10; $i++)
                    <div class="mb-4">
                        <label for="row_{{ $i }}_photo_path" class="block text-base font-medium text-gray-700 dark:text-gray-300">列{{ $i }}</label>
                        <div class="relative">
                            <input type="file" id="row_{{ $i }}_photo_path" name="row_{{ $i }}_photo_path" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="row_{{ $i }}_preview">
                            <div id="row_{{ $i }}_preview" class="preview-container">
                                @if ($photo = $report->rowPhotos->firstWhere('row_number', $i))
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="プレビュー画像" class="h-32 object-contain rounded-md mt-2">
                                @endif
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- 東側通路 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">東側通路</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">最大6件まで添付可能</p>
                <input type="file" id="east_photo_path" name="east_photo_path[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="east_path_preview">
                <div id="east_path_preview" class="preview-container flex flex-wrap gap-2 mt-2">
                    @foreach ($report->eastPathPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="プレビュー画像" class="h-32 object-contain rounded-md">
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像（最大10MBまで）アップロードしてください。</p>
            </div>

            <!-- 南側通路 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">南側通路</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">最大6件まで添付可能</p>
                <input type="file" id="south_photo_path" name="south_photo_path[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="south_path_preview">
                <div id="south_path_preview" class="preview-container flex flex-wrap gap-2 mt-2">
                    @foreach ($report->southPathPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="プレビュー画像" class="h-32 object-contain rounded-md">
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像（最大10MBまで）アップロードしてください。</p>
            </div>

            @for ($i = 1; $i <= 3; $i++)
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow mb-4">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">除草に関する特記事項 {{ $i }}</h2>

                    <!-- タイトル入力 -->
                    <label for="weeding_note_{{ $i }}_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">タイトル</label>
                    <input type="text" id="weeding_note_{{ $i }}_title" name="weeding_note_{{ $i }}_title" value="{{ old("weeding_note_{$i}_title", $report->weedingNotes[$i - 1]->title ?? '') }}" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">

                    <!-- 写真アップロード -->
                    <label for="weeding_note_{{ $i }}_photo_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">写真</label>
                    <input type="file" id="weeding_note_{{ $i }}_photo_path" name="weeding_note_{{ $i }}_photo_path" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-1 preview-input" data-preview-target="weeding_note_{{ $i }}_preview">
                    <div id="weeding_note_{{ $i }}_preview" class="preview-container mt-2">
                        @if (!empty($report->weedingNotes[$i - 1]->photo_path))
                            <img src="{{ asset('storage/' . $report->weedingNotes[$i - 1]->photo_path) }}" alt="特記事項 {{ $i }} の写真" class="h-32 object-contain rounded-md mt-2">
                        @endif
                    </div>

                    <!-- 説明文入力 -->
                    <label for="weeding_note_{{ $i }}_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">説明文</label>
                    <textarea id="weeding_note_{{ $i }}_description" name="weeding_note_{{ $i }}_description" rows="3" class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old("weeding_note_{$i}_description", $report->weedingNotes[$i - 1]->description ?? '') }}</textarea>
                </div>
            @endfor

            <div class="flex justify-between">
                <a href="{{ route('edit', ['report' => $report->id] )}}" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                    前へ
                </a>
                <button type="submit" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    次へ
                </button>
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
