<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>内容確認 | 報告書作成フォーム</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">

        <h1 class="text-2xl font-bold mb-6 text-center">内容確認</h1>

        @if (session('message'))
        <div id="flash-message" class="fixed bottom-15 right-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- First Page Inputs -->
        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">基本情報</h2>
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
                <tbody>
                    <tr>
                        <th class="py-2 font-medium text-gray-900 dark:text-gray-100">実施報告日</th>
                        <td class="py-2">{{ $report->reported_at ? $report->reported_at->format('Y年n月j日') : '' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 font-medium text-gray-900 dark:text-gray-100">作業日</th>
                        <td class="py-2">{{ $report->worked_at ? $report->worked_at->format('Y年n月j日') : '' }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 font-medium text-gray-900 dark:text-gray-100">発電所名</th>
                        <td class="py-2">{{ $report->plant_name }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 font-medium text-gray-900 dark:text-gray-100">物件住所</th>
                        <td class="py-2">{{ $report->property_address }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 font-medium text-gray-900 dark:text-gray-100">天気</th>
                        <td class="py-2">{{ $report->weather }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4">
                <a href="{{ route('report.edit', ['report' => $report->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">基本情報を編集する</a>
            </div>
        </div>

        <!-- Second Page Inputs -->
        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">目視点検１</h2>

            <!-- 看板写真 -->
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">看板写真</h3>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>看板写真:</strong> 
                @if ($report->signboard_thumbnail_path)
                    <img src="{{ asset('storage/' . $report->signboard_thumbnail_path) }}" alt="看板写真" class="mt-2 max-h-40 rounded-md">
                @elseif ($report->signboard_photo_path)
                    <img src="{{ asset('storage/' . $report->signboard_photo_path) }}" alt="看板写真" class="mt-2 max-h-40 rounded-md">
                @else
                    未アップロード
                @endif
            </p>

            <!-- 南から1~10列目 -->
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2 mt-6">南から1~10列目</h3>
            @for ($i = 1; $i <= 10; $i++)
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>列{{ $i }}:</strong></p>
                <div class="flex flex-wrap gap-2">
                    @if ($photo = $report->rowPhotos->firstWhere('row_number', $i))
                        @if ($photo->thumbnail_path)
                            <img src="{{ asset('storage/' . $photo->thumbnail_path) }}" alt="列{{ $i }}の写真" class="mt-2 max-h-40 rounded-md">
                        @else
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="列{{ $i }}の写真" class="mt-2 max-h-40 rounded-md">
                        @endif
                    @else
                        <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                    @endif
                </div>
            @endfor

            <!-- 東側通路 -->
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2 mt-6">東側通路</h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($report->eastPathPhotos as $photo)
                    @if ($photo->thumbnail_path)
                        <img src="{{ asset('storage/' . $photo->thumbnail_path) }}" alt="東側通路写真" class="mt-2 max-h-40 rounded-md">
                    @else
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="東側通路写真" class="mt-2 max-h-40 rounded-md">
                    @endif
                @endforeach
                @if ($report->eastPathPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('inspection.first', ['report' => $report->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">目視点検１を編集する</a>
            </div>
        </div>

        <!-- Third Page Inputs -->
        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">目視点検２</h2>

            <!-- 集電箱 -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">集電箱</h3>
                @if ($report->junction_box_photo)
                    <img src="{{ asset('storage/' . $report->junction_box_photo) }}" alt="集電箱画像" class="mt-2 max-h-40 rounded-md">
                @else
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <!-- 集電箱内 -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">集電箱内</h3>
                @if ($report->inside_junction_box_photo)
                    <img src="{{ asset('storage/' . $report->inside_junction_box_photo) }}" alt="集電箱内画像" class="mt-2 max-h-40 rounded-md">
                @else
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <!-- パワコン全景 -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パワコン全景</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->power_converter_status ?? '未選択' }}</p>
                @foreach ($report->powerConverterPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パワコン全景画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->powerConverterPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <!-- 配管パテ -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">配管パテ</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->pipe_putty_status ?? '未選択' }}</p>
                @foreach ($report->pipePuttyPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="配管パテ画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->pipePuttyPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <!-- 架台 -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">架台</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->panel_array_status ?? '未選択' }}</p>
                @foreach ($report->panelArrayPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="架台画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->panelArrayPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <!-- パネル汚れ有無 -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パネル汚れ</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->panel_condition_status ?? '未選択' }}</p>
                @foreach ($report->panelConditionPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パネル汚れ有無画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->panelConditionPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('inspection.second', ['report' => $report->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">目視点検２を編集する</a>
            </div>
        </div>

        <!-- 目視点検３ -->
        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">目視点検３</h2>
            <!-- パワコン -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パワコン</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->power_converter_status ?? '未選択' }}</p>
                @foreach ($report->powerConverterPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パワコン全景画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->powerConverterPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>
            <!-- 配管パテ -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">配管パテ</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->pipe_putty_status ?? '未選択' }}</p>
                @foreach ($report->pipePuttyPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="配管パテ画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->pipePuttyPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>
            <div class="mt-4">
                <a href="{{ route('inspection.third', ['report' => $report->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">目視点検３を編集する</a>
            </div>
        </div>

        <!-- 目視点検４ -->
        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">目視点検４</h2>
            <!-- 架台 -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">架台</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->panel_array_status ?? '未選択' }}</p>
                @foreach ($report->panelArrayPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="架台画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->panelArrayPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>
            <!-- パネル汚れ -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パネル汚れ</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>状態:</strong> {{ $report->panel_condition_status ?? '未選択' }}</p>
                @foreach ($report->panelConditionPhotos as $photo)
                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="パネル汚れ画像" class="mt-2 max-h-40 rounded-md">
                @endforeach
                @if ($report->panelConditionPhotos->isEmpty())
                    <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                @endif
            </div>
            <div class="mt-4">
                <a href="{{ route('inspection.forth', ['report' => $report->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">目視点検４を編集する</a>
            </div>
        </div>

        <!-- Fourth Page Inputs -->
        <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">その他</h2>
            @for ($i = 1; $i <= 3; $i++)
                <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h4 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">特記事項{{ $i }}</h4>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-2"style="overflow-wrap: break-word;white-space: pre-line;">
                        <strong>タイトル:</strong>
                        {{ $report->specialNotes->firstWhere('index', $i)->title ?? '未入力' }}
                    </p>
                    <div class="flex items-center justify-center mb-4">
                        @if ($photo = $report->specialNotes->firstWhere('index', $i))
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="特記事項{{ $i }}の写真" class="max-h-40 rounded-md">
                        @else
                            <p class="text-sm text-gray-700 dark:text-gray-300">未アップロード</p>
                        @endif
                    </div>
                    <p class="text-sm text-gray-700 dark:text-gray-300" style="overflow-wrap: break-word;white-space: pre-line;">
                        <strong>説明:</strong>
                        {{ $report->specialNotes->firstWhere('index', $i)->description ?? '未入力' }}
                    </p>
                </div>
            @endfor

            <!-- 備考欄 -->
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">備考</h3>
                <p class="text-sm text-gray-700 dark:text-gray-300" style="word-break: break-word;">{{ $report->remarks ?? '未入力' }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('inspection.third', ['report' => $report->id]) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">その他を編集する</a>
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('remark', ['report' => $report->id])}}" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                前へ
            </a>
            <a href="{{ route('export', ['report' => $report->id]) }}" id="printing-button" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center flex items-center justify-center">
                PDFを印刷
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17v1a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-1M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2m2 4v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                </svg>
            </a>
        </div>

            <div>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('welcome') }}"
                       class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition text-left block w-auto px-0 py-0 bg-transparent rounded-none focus:outline-none focus:ring-0"
                       style="box-shadow:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 inline-block align-text-bottom" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l-4-4m0 0l4-4m-4 4h11a4 4 0 010 8h-1"/>
                        </svg>報告書作成フォーム
                    </a>
                </div>
            </div>
    </div>

    <div class="fixed bottom-4 right-4 flex flex-col items-end space-y-2">
        <a href="{{ route('export', ['report' => $report->id]) }}" id="fab-printing-button"
           class="flex items-center bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-full shadow hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17v1a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-1M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2m2 4v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
            </svg>
            PDFを印刷
        </a>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
