<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目視点検２ | 報告書作成フォーム</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full">
                <div class="h-2 bg-indigo-600 rounded-full" style="width: 75%;"></div>
            </div>
            <div class="flex space-x-2 text-sm text-gray-500 dark:text-gray-400 ml-4">
                <span>3 / 4</span>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">目視点検２</h1>

        @if (session('message'))
        <div id="flash-message" class="fixed bottom-15 right-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('third-page.update' , ['report' => $report->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 集電箱と集電箱内 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">集電箱と集電箱内</h2>

                <!-- 集電箱 -->
                <div class="mb-4">
                    <label for="junction_box_photo" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">集電箱</label>
                    <input type="file" id="junction_box_photo" name="junction_box_photo" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="junction_box_preview">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                    <div id="junction_box_preview" class="preview-container mt-2">
                        @if ($report->junction_box_photo)
                            <img src="{{ asset('storage/' . $report->junction_box_photo) }}" alt="集電箱画像" class="h-32 object-contain rounded-md">
                        @endif
                    </div>
                </div>

                <!-- 集電箱内 -->
                <div>
                    <label for="inside_junction_box_photo" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">集電箱内</label>
                    <input type="file" id="inside_junction_box_photo" name="inside_junction_box_photo" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="inside_junction_box_preview">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                    <div id="inside_junction_box_preview" class="preview-container mt-2">
                        @if ($report->inside_junction_box_photo)
                            <img src="{{ asset('storage/' . $report->inside_junction_box_photo) }}" alt="集電箱内画像" class="h-32 object-contain rounded-md">
                        @endif
                    </div>
                </div>
            </div>

            <!-- パワコン1～10台目 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">パワコン1～10台目</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">パワコン台数分終わったら飛ばしてください。</p>
                @for ($i = 1; $i <= 10; $i++)
                <div class="mb-4">
                    <label for="power_converter_{{ $i }}_photo" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">パワコン{{ $i }}台目</label>
                    <input type="file" id="power_converter_{{ $i }}_photo" name="power_converter_{{ $i }}_photo" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="power_converter_{{ $i }}_preview">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像（最大10MB）をアップロードしてください。</p>
                    <div id="power_converter_{{ $i }}_preview" class="preview-container mt-2">
                        @if ($photo = $report->powerConverters->firstWhere('index', $i))
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パワコン{{ $i }}台目の写真" class="h-32 object-contain rounded-md">
                        @endif
                    </div>
                </div>
                @endfor
            </div>

            <!-- パワコン -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パワコン</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">状態と全景画像を入力してください。</p>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">状態</p>
                <div class="space-y-2 flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="power_converter_status" value="〇" {{ old('power_converter_status', $report->power_converter_status ?? '〇') === '〇' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">〇</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="power_converter_status" value="△" {{ old('power_converter_status', $report->power_converter_status ?? '〇') === '△' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">△</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="power_converter_status" value="×" {{ old('power_converter_status', $report->power_converter_status ?? '〇') === '×' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">×</span>
                    </label>
                </div>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mt-4 mb-4">パワコン全景（最大6件まで添付可能）</p>
                <input type="file" id="power_converter_photo" name="power_converter_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="power_converter_preview">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                <div id="power_converter_preview" class="preview-container flex flex-wrap gap-2 mt-2">
                    @foreach ($report->powerConverterPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パワコン画像" class="h-32 object-contain rounded-md">
                    @endforeach
                </div>
            </div>

            <!-- 配管パテ -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">配管パテ</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">状態と画像を入力してください。</p>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">状態</p>
                <div class="space-y-2 flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="pipe_putty_status" value="〇" {{ old('pipe_putty_status', $report->pipe_putty_status ?? '〇') === '〇' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">〇</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pipe_putty_status" value="△" {{ old('pipe_putty_status', $report->pipe_putty_status ?? '〇') === '△' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">△</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pipe_putty_status" value="×" {{ old('pipe_putty_status', $report->pipe_putty_status ?? '〇') === '×' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">×</span>
                    </label>
                </div>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mt-4 mb-4">画像（最大6件まで添付可能）</p>
                <input type="file" id="pipe_putty_photo" name="pipe_putty_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="pipe_putty_preview">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                <div id="pipe_putty_preview" class="preview-container flex flex-wrap gap-2 mt-2">
                    @foreach ($report->pipePuttyPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="配管パテ画像" class="h-32 object-contain rounded-md">
                    @endforeach
                </div>
            </div>

            <!-- 架台 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">架台</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">状態と画像を入力してください。</p>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">状態</p>
                <div class="space-y-2 flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="panel_array_status" value="〇" {{ old('panel_array_status', $report->panel_array_status ?? '〇') === '〇' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">〇</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="panel_array_status" value="△" {{ old('panel_array_status', $report->panel_array_status ?? '〇') === '△' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">△</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="panel_array_status" value="×" {{ old('panel_array_status', $report->panel_array_status ?? '〇') === '×' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">×</span>
                    </label>
                </div>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mt-4 mb-4">画像（最大6件まで添付可能）</p>
                <input type="file" id="panel_array_photo" name="panel_array_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="panel_array_preview">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                <div id="panel_array_preview" class="preview-container flex flex-wrap gap-2 mt-2">
                    @foreach ($report->panelArrayPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="架台画像" class="h-32 object-contain rounded-md">
                    @endforeach
                </div>
            </div>

            <!-- パネル汚れ -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パネル汚れ</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">状態と画像を入力してください。</p>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">状態</p>
                <div class="space-y-2 flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="panel_condition_status" value="〇" {{ old('panel_condition_status', $report->panel_condition_status ?? '〇') === '〇' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">〇</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="panel_condition_status" value="△" {{ old('panel_condition_status', $report->panel_condition_status ?? '〇') === '△' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">△</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="panel_condition_status" value="×" {{ old('panel_condition_status', $report->panel_condition_status ?? '〇') === '×' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 items-center">×</span>
                    </label>
                </div>
                <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mt-4 mb-4">画像（最大6件まで添付可能）</p>
                <input type="file" id="panel_condition_photo" name="panel_condition_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 preview-input" data-preview-target="panel_condition_preview">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                <div id="panel_condition_preview" class="preview-container flex flex-wrap gap-2 mt-2">
                    @foreach ($report->panelConditionPhotos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パネル汚れ画像" class="h-32 object-contain rounded-md">
                    @endforeach
                </div>
            </div>

            <div>
                <div class="flex justify-between">
                    <a href="{{ route('second-page', ['report' => $report->id]) }}" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                        前へ
                    </a>
                    <button type="submit" id="loading-button" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        次へ
                    </button>
                </div>
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
