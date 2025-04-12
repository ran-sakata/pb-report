<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>報告書作成フォーム</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="flex items-center justify-between mb-6">
                <div class="flex-1">
                    <div class="h-2 bg-indigo-600 rounded-full" style="width: 25%;"></div>
                </div>
                <div class="flex space-x-2 text-sm text-gray-500 dark:text-gray-400 ml-4">
                    <span>1 / 4</span>
                </div>
            </div>

            <h1 class="text-2xl font-bold mb-6 text-center">報告書作成フォーム</h1>
            <form action="{{ isset($report) ? route('report.edit', [ 'report' => $report?->id ]) : route('report.store', ['report' => $report?->id]) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reported_at" class="block text-base font-medium text-gray-700 dark:text-gray-300">実施報告日</label>
                    <input 
                        type="date" 
                        id="date" 
                        name="reported_at" 
                        value="{{ old('date', $report?->reported_at ?? date('Y-m-d')) }}" 
                        required 
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('reported_at')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="worked_at" class="block text-base font-medium text-gray-700 dark:text-gray-300">作業日</label>
                    <input 
                        type="date" 
                        id="worked_at" 
                        name="worked_at" 
                        value="{{ old('worked_at', $report?->worked_at ?? '') }}" 
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('worked_at')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="plant_name" class="block text-base font-medium text-gray-700 dark:text-gray-300">発電所名</label>
                    <input 
                        type="text" 
                        id="plant_name" 
                        name="plant_name" 
                        value="{{ old('plant_name', $report?->plant_name ?? '') }}"
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('plant_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="property_address" class="block text-base font-medium text-gray-700 dark:text-gray-300">物件住所</label>
                    <input 
                        type="text" 
                        id="property_address" 
                        name="property_address" 
                        value="{{ old('property_address', $report?->property_address ?? '') }}"
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                </div>
                <div>
                    <span class="block text-base font-medium text-gray-700 dark:text-gray-300">天気</span>
                    <div class="mt-2 flex space-x-4">
                        <label class="flex items-center">
                            <input 
                                type="radio" 
                                name="weather" 
                                value="晴れ" 
                                {{ old('weather', $report?->weather ?? '') === '晴れ' ? 'checked' : '' }}
                                class="text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-400 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">晴れ</span>
                        </label>
                        <label class="flex items-center">
                            <input 
                                type="radio" 
                                name="weather" 
                                value="曇り" 
                                {{ old('weather', $report?->weather ?? '') === '曇り' ? 'checked' : '' }} 
                                class="text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-400 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">曇り</span>
                        </label>
                        <label class="flex items-center">
                            <input 
                                type="radio" 
                                name="weather" 
                                value="雨" 
                                {{ old('weather', $report?->weather ?? '') === '雨' ? 'checked' : '' }} 
                                class="text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-400 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">雨</span>
                        </label>
                    </div>
                    @error('weather')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="w-full bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        次へ
                    </button>
                </div>
            </form>
            <div>
                <a href="{{ route('welcome') }}" class="w-full inline-block bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mt-4">
                    はじめに戻る
                </a>
            </div>
            <div class="flex justify-between mt-4">
                <a href="{{ route('welcome') }}" class="w-full bg-gray-500 dark:bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-300 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center">
                    はじめに戻る
                </a>
            </div>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
