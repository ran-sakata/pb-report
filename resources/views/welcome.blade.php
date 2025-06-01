<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>報告書作成フォーム</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md text-center">
            <h1 class="text-2xl font-bold mb-6">報告書作成フォーム</h1>
            <a href="{{ route('report.create') }}" class="w-full inline-block bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                はじめる
            </a>
            <a href="{{ route('history') }}" class="w-full inline-block bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 mt-4">
                途中から始める
            </a>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
