<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認画面</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-center">入力内容の確認</h1>

        <!-- First Page Inputs -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">基本情報</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>実施報告日:</strong> {{ $report->reported_at }}</p>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>作業日:</strong> {{ $report->worked_at }}</p>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>発電所名:</strong> {{ $report->plant_name }}</p>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>物件住所:</strong> {{ $report->property_address }}</p>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>天気:</strong> {{ $report->weather }}</p>
            <div class="mt-4">
                <a href="/{{ $report->id }}/" class="text-indigo-600 dark:text-indigo-400 hover:underline">基本情報を編集する</a>
            </div>
        </div>

        <!-- Second Page Inputs -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">写真情報</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>看板写真:</strong> 
                @if ($report->signboard_photo_path)
                    <img src="{{ asset('storage/' . $report->signboard_photo_path) }}" alt="看板写真" class="mt-2 max-h-40 rounded-md">
                @else
                    未アップロード
                @endif
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>東側通路:</strong> 
                @if ($report->east_path_photo_path)
                    <img src="{{ asset('storage/' . $report->east_path_photo_path) }}" alt="東側通路" class="mt-2 max-h-40 rounded-md">
                @else
                    未アップロード
                @endif
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>南側通路:</strong> 
                @if ($report->south_path_photo_path)
                    <img src="{{ asset('storage/' . $report->south_path_photo_path) }}" alt="南側通路" class="mt-2 max-h-40 rounded-md">
                @else
                    未アップロード
                @endif
            </p>
            <div class="mt-4">
                <a href="/{{ $report->id }}/second-page" class="text-indigo-600 dark:text-indigo-400 hover:underline">写真情報を編集する</a>
            </div>
        </div>

        <!-- Third Page Inputs -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">詳細情報</h2>
            @for ($i = 1; $i <= 10; $i++)
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>パワコン{{ $i }}台目:</strong> 
                    @if ($report->{'power_converter_' . $i . '_photo'})
                        <img src="{{ asset('storage/' . $report->{'power_converter_' . $i . '_photo'}) }}" alt="パワコン{{ $i }}台目" class="mt-2 max-h-40 rounded-md">
                    @else
                        未アップロード
                    @endif
                </p>
            @endfor

            @for ($i = 1; $i <= 6; $i++)
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>パワコン全景{{ $i }}:</strong> 
                    @if ($report->{'power_converter_overview_' . $i . '_photo'})
                        <img src="{{ asset('storage/' . $report->{'power_converter_overview_' . $i . '_photo'}) }}" alt="パワコン全景{{ $i }}" class="mt-2 max-h-40 rounded-md">
                    @else
                        未アップロード
                    @endif
                </p>
            @endfor

            @for ($i = 1; $i <= 5; $i++)
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>配管パテ写真{{ $i }}:</strong> 
                    @if ($report->{'pipe_putty_' . $i . '_photo'})
                        <img src="{{ asset('storage/' . $report->{'pipe_putty_' . $i . '_photo'}) }}" alt="配管パテ写真{{ $i }}" class="mt-2 max-h-40 rounded-md">
                    @else
                        未アップロード
                    @endif
                </p>
            @endfor
            <div class="mt-4">
                <a href="/{{ $report->id }}/third-page" class="text-indigo-600 dark:text-indigo-400 hover:underline">詳細情報を編集する</a>
            </div>
        </div>

        <!-- 特記事項 -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">特記事項</h2>
            @for ($i = 1; $i <= 3; $i++)
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>特記事項{{ $i }}タイトル:</strong> {{ $report->{'special_note_title_' . $i} }}</p>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>特記事項{{ $i }}説明:</strong> {{ $report->{'special_note_description_' . $i} }}</p>
                <p class="text-sm text-gray-700 dark:text-gray-300"><strong>特記事項{{ $i }}写真:</strong> 
                    @if ($report->{'special_note_photo_' . $i})
                        <img src="{{ asset('storage/' . $report->{'special_note_photo_' . $i}) }}" alt="特記事項{{ $i }}写真" class="mt-2 max-h-40 rounded-md">
                    @else
                        未アップロード
                    @endif
                </p>
            @endfor
        </div>

        <div class="w-full flex justify-center">
            <a href="{{ route('export', ['report' => $report->id]) }}" 
               class="w-full bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 flex justify-center items-center">
                この内容でダウンロード
            </a>
        </div>
    </div>
</body>
</html>
