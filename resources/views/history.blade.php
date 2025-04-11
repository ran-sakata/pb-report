<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>履歴</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-4xl">
            <h1 class="text-2xl font-bold mb-6 text-center">作成済みの報告書</h1>
            <ul class="space-y-4">
                @forelse ($reports as $report)
                    <a href="{{ route('report.edit', ['report' => $report->id]) }}" class="block bg-white dark:bg-gray-800 p-4 rounded shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                        <li>
                            <div class="flex pb-2">
                                <span class="w-24 text-sm font-medium text-gray-700 dark:text-gray-300">更新日時:</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $report->updated_at }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-24 text-sm font-medium text-gray-700 dark:text-gray-300">実施報告日:</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $report->reported_at }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-24 text-sm font-medium text-gray-700 dark:text-gray-300">作業日:</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $report->worked_at ? $report->worked_at : '入力されていません' }}
                                </span>
                            </div>
                            <div class="flex">
                                <span class="w-24 text-sm font-medium text-gray-700 dark:text-gray-300">発電所名:</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $report->plant_name ? $report->plant_name : '入力されていません' }}
                                </span>
                            </div>
                        </li>
                    </a>
                @empty
                    <li class="text-center text-gray-500 dark:text-gray-400 py-4">作成済みの報告書はありません。</li>
                @endforelse
            </ul>
            <div class="mt-6">
                {{ $reports->links('pagination::tailwind') }}
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('welcome') }}" class="w-full inline-block bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    はじめに戻る
                </a>
            </div>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
