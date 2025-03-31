<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目視点検 | 報告書作成フォーム</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1">
                <div class="h-2 bg-indigo-600 rounded-full" style="width: 75%;"></div>
            </div>
            <div class="flex space-x-2 text-sm text-gray-500 dark:text-gray-400 ml-4">
                <span>3 / 4</span>
            </div>
        </div>

        <h1 class="text-2xl font-bold mb-6 text-center">目視点検</h1>

        @if (session('message'))
        <div id="flash-message" class="fixed bottom-15 right-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <form action="/{{ $report->id }}/third-page" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- 集電箱と集電箱内 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">集電箱と集電箱内</h2>

                <!-- 集電箱 -->
                <div class="mb-4">
                    <label for="junction_box_photo" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">集電箱</label>
                    <input type="file" id="junction_box_photo" name="junction_box_photo" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                    @if ($report->junction_box_photo)
                        <img src="{{ asset('storage/' . $report->junction_box_photo) }}" alt="集電箱画像" class="mt-2 max-h-40 rounded-md">
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_junction_box_photo" value="1" class="form-checkbox text-red-600 dark:text-red-400">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">この写真を削除する</span>
                            </label>
                        </div>
                    @endif
                    @error('junction_box_photo')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 集電箱内 -->
                <div>
                    <label for="inside_junction_box_photo" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">集電箱内</label>
                    <input type="file" id="inside_junction_box_photo" name="inside_junction_box_photo" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像をアップロードしてください。</p>
                    <img id="inside_junction_box_photo_preview" class="mt-2 max-h-40 rounded-md" style="display: {{ $report->inside_junction_box_photo ? 'block' : 'none' }};" src="{{ $report->inside_junction_box_photo ? asset('storage/' . $report->inside_junction_box_photo) : '' }}" />
                    @if ($report->inside_junction_box_photo)
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_inside_junction_box_photo" value="1" class="form-checkbox text-red-600 dark:text-red-400">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">この写真を削除する</span>
                            </label>
                        </div>
                    @endif
                    @error('inside_junction_box_photo')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- パワコン1～10台目 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">パワコン1～10台目</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">パワコン台数分終わったら飛ばしてください。</p>
                @for ($i = 1; $i <= 10; $i++)
                <div class="mb-4">
                    <label for="power_converter_{{ $i }}_photo" class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">パワコン{{ $i }}台目</label>
                    <input type="file" id="power_converter_{{ $i }}_photo" name="power_converter_{{ $i }}_photo" accept="image/*"class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像（最大10MB）をアップロードしてください。</p>
                    <img id="power_converter_{{ $i }}_photo_preview" class="mt-2 max-h-40 rounded-md" style="display: {{ $report->{'power_converter_' . $i . '_photo'} ? 'block' : 'none' }};" src="{{ $report->{'power_converter_' . $i . '_photo'} ? asset('storage/' . $report->{'power_converter_' . $i . '_photo'}) : '' }}" />
                    @if ($report->{'power_converter_' . $i . '_photo'})
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_power_converter_{{ $i }}_photo" value="1" class="form-checkbox text-red-600 dark:text-red-400">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">この写真を削除する</span>
                            </label>
                        </div>
                    @endif
                    @error("power_converter_{{ $i }}_photo")
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endfor
            </div>

            <!-- パワコン全景 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パワコン全景</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">最大6件まで添付可能</p>
                <input type="file" id="power_converter_overview_photo" name="power_converter_overview_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像を最大6件（各10MBまで）アップロードしてください。</p>
            </div>

            <!-- 配管パテ -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">配管パテ</h2>
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">最大6件まで添付可能</p>
                <input type="file" id="pipe_putty_photo" name="pipe_putty_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像を最大6件（各10MBまで）アップロードしてください。</p>
            </div>

            <!-- パネルアレイ -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">パネルアレイ</h2>
                <input type="file" id="panel_array_photo" name="panel_array_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像を最大6件（各10MBまで）アップロードしてください。</p>
            </div>

            <!-- パネル汚れ有無 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">パネル汚れ有無</h2>
                <input type="file" id="panel_condition_photo" name="panel_condition_photo[]" accept="image/*" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">JPEG, PNG, JPG, GIF形式の画像を最大6件（各10MBまで）アップロードしてください。</p>
            </div>

            <div>
                <div class="flex justify-between">
                    <a href="/{{ $report->id }}/second-page" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                        前へ
                    </a>
                    <button type="submit" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        次へ
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
