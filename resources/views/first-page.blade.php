<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>報告書作成フォーム</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">

            <h1 class="text-2xl font-bold mb-6 text-center">報告書作成フォーム</h1>
            <form action="{{ isset($report?->id) ? route('report.edit', ['report' => $report->id]) : route('report.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reported_at" class="block text-base font-medium text-gray-700 dark:text-gray-300">実施報告日</label>
                    <input 
                        type="date" 
                        id="date" 
                        name="reported_at" 
                        value="{{ old('date', $report?->reported_at?->format('Y-m-d') ?? date('Y-m-d')) }}" 
                        required 
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
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
                        value="{{ old('worked_at', $report?->worked_at?->format('Y-m-d') ?? date('Y-m-d')) }}" 
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
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
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
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
                        class="text-lg mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-400 dark:focus:border-indigo-400 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    @error('property_address')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <span class="block text-base font-medium text-gray-700 dark:text-gray-300">天気</span>
                    <div class="mt-2 w-full flex">
                        <div class="inline-flex w-full divide-x divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800 rounded-md shadow-sm" role="group">
                            <div class="flex-1">
                                <input type="radio" id="weather_sunny" name="weather" value="晴れ"
                                    class="peer hidden"
                                    {{ old('weather', $report?->weather ?? '') === '晴れ' ? 'checked' : '' }}>
                                <label for="weather_sunny"
                                    class="flex flex-row items-center justify-center w-full h-full px-4 py-2 rounded-l-md cursor-pointer text-sm font-medium
                                        bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-yellow-100 dark:hover:bg-yellow-900 hover:text-yellow-700 dark:hover:text-yellow-200
                                        peer-checked:bg-yellow-100 peer-checked:dark:bg-yellow-900 peer-checked:text-yellow-700 peer-checked:dark:text-yellow-200 transition-colors">
                                    <!-- Sun Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2" fill="currentColor" class="text-yellow-400"/>
                                        <g stroke="currentColor" stroke-width="2">
                                            <line x1="12" y1="2" x2="12" y2="4"/>
                                            <line x1="12" y1="20" x2="12" y2="22"/>
                                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                            <line x1="2" y1="12" x2="4" y2="12"/>
                                            <line x1="20" y1="12" x2="22" y2="12"/>
                                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                                        </g>
                                    </svg>
                                    <span>晴れ</span>
                                </label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="weather_cloudy" name="weather" value="曇り"
                                    class="peer hidden"
                                    {{ old('weather', $report?->weather ?? '') === '曇り' ? 'checked' : '' }}>
                                <label for="weather_cloudy"
                                    class="flex flex-row items-center justify-center w-full h-full px-4 py-2 cursor-pointer text-sm font-medium
                                        bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-gray-700 dark:hover:text-gray-200
                                        peer-checked:bg-gray-200 peer-checked:dark:bg-gray-700 peer-checked:text-gray-700 peer-checked:dark:text-gray-200 transition-colors">
                                    <!-- Cloud Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M7 18a5 5 0 1 1 2-9.584A7 7 0 0 1 20 15a4 4 0 0 1-4 4H7z" fill="currentColor" class="text-gray-400"/>
                                    </svg>
                                    <span>曇り</span>
                                </label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="weather_rain" name="weather" value="雨"
                                    class="peer hidden"
                                    {{ old('weather', $report?->weather ?? '') === '雨' ? 'checked' : '' }}>
                                <label for="weather_rain"
                                    class="flex flex-row items-center justify-center w-full h-full px-4 py-2 rounded-r-md cursor-pointer text-sm font-medium
                                        bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-blue-100 dark:hover:bg-blue-900 hover:text-blue-700 dark:hover:text-blue-200
                                        peer-checked:bg-blue-100 peer-checked:dark:bg-blue-900 peer-checked:text-blue-700 peer-checked:dark:text-blue-200 transition-colors">
                                    <!-- CloudRain Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M7 18a5 5 0 1 1 2-9.584A7 7 0 0 1 20 15a4 4 0 0 1-4 4H7z" fill="currentColor" class="text-blue-400"/>
                                        <line x1="9" y1="20" x2="9" y2="22" stroke="currentColor" stroke-width="2" class="text-blue-400"/>
                                        <line x1="12" y1="20" x2="12" y2="22" stroke="currentColor" stroke-width="2" class="text-blue-400"/>
                                        <line x1="15" y1="20" x2="15" y2="22" stroke="currentColor" stroke-width="2" class="text-blue-400"/>
                                    </svg>
                                    <span>雨</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('weather')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" id="loading-button" class="w-full bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        次へ
                    </button>
                </div>
            </form>
            <div>
                <a href="{{ route('welcome') }}" class="w-full inline-block bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mt-4">
                    はじめに戻る
                </a>
            </div>
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
