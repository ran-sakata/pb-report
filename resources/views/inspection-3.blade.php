<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目視点検３ | 報告書作成フォーム</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex items-center justify-center min-h-screen">
    <!-- クイックナビ: 上部固定・上スクロール時のみ表示 -->
    <div id="quick-nav-bar" class="fixed top-0 left-0 right-0 flex justify-center z-50 transition-transform duration-300 -translate-y-full">
        <nav class="flex space-x-4 w-auto max-w-full px-2 py-2 overflow-x-auto scrollbar-none" style="-ms-overflow-style: none; scrollbar-width: none;">
            <!-- 目視点検１グループ -->
            <div class="flex flex-col items-start">
                <span class="text-xs text-gray-500 mb-1 ml-1">目視点検１</span>
                <div class="flex space-x-2">
                    <a href="{{ route('inspection.first', ['report' => $report->id]) }}#signboard-photo"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        看板写真
                    </a>
                    <a href="{{ route('inspection.first', ['report' => $report->id]) }}#row-photos"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        南から1~10列目
                    </a>
                    <a href="{{ route('inspection.first', ['report' => $report->id]) }}#east-path-photos"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        東側通路
                    </a>
                    <a href="{{ route('inspection.first', ['report' => $report->id]) }}#west-path-photos"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        西側通路
                    </a>
                </div>
            </div>
            <!-- 目視点検２グループ -->
            <div class="flex flex-col items-start">
                <span class="text-xs text-gray-500 mb-1 ml-1">目視点検２</span>
                <div class="flex space-x-2">
                    <a href="{{ route('inspection.second', ['report' => $report->id]) }}#junction-box"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        集電箱
                    </a>
                    <a href="{{ route('inspection.second', ['report' => $report->id]) }}#inside-junction-box"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        集電箱内
                    </a>
                    <a href="{{ route('inspection.second', ['report' => $report->id]) }}#power-converters"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        パワコン1~10台目
                    </a>
                </div>
            </div>
            <!-- 目視点検３グループ -->
            <div class="flex flex-col items-start">
                <span class="text-xs text-gray-500 mb-1 ml-1">目視点検３</span>
                <div class="flex space-x-2">
                    <a href="{{ route('inspection.third', ['report' => $report->id]) }}#power-converter"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        パワコン
                    </a>
                    <a href="{{ route('inspection.third', ['report' => $report->id]) }}#pipe-putty"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        配管パテ
                    </a>
                </div>
            </div>
            <!-- 目視点検４グループ -->
            <div class="flex flex-col items-start">
                <span class="text-xs text-gray-500 mb-1 ml-1">目視点検４</span>
                <div class="flex space-x-2">
                    <a href="{{ route('inspection.forth', ['report' => $report->id]) }}#panel-array"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        架台
                    </a>
                    <a href="{{ route('inspection.forth', ['report' => $report->id]) }}#panel-condition"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        パネル汚れ
                    </a>
                </div>
            </div>
            <!-- その他グループ -->
            <div class="flex flex-col items-start">
                <span class="text-xs text-gray-500 mb-1 ml-1">その他</span>
                <div class="flex space-x-2">
                    <a href="{{ route('remark', ['report' => $report->id]) }}#specialnote"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        特記事項
                    </a>
                    <a href="{{ route('remark', ['report' => $report->id]) }}#remark"
                       class="quicknav-link px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        備考
                    </a>
                </div>
            </div>
            <!-- 内容確認リンク -->
            <div class="flex flex-col items-start">
                <span class="text-xs text-transparent mb-1 ml-1">内容確認</span>
                <div class="flex space-x-2">
                    <a href="{{ route('confirmation',['report' => $report->id]) }}"
                       class="px-3 py-2 rounded-full bg-white/80 dark:bg-gray-800/80 shadow flex items-center text-sm font-medium text-gray-800 dark:text-gray-200 hover:bg-indigo-100/80 dark:hover:bg-indigo-900/80 whitespace-nowrap transition border-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        内容確認
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <div class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full">
                <div class="h-2 bg-indigo-600 rounded-full" style="width: 60%;"></div>
            </div>
            <div class="flex space-x-2 text-sm text-gray-500 dark:text-gray-400 ml-4">
                <span>3 / 5</span>
            </div>
        </div>
        <h1 class="text-2xl font-bold mb-6 text-center">目視点検３</h1>
        <div class="text-center text-base text-gray-600 dark:text-gray-300 mb-8">{{ $report->plant_name }}</div>
        {{-- アンカー: パワコン --}}
        <div id="power-converter" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow mb-4 scroll-mt-24">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">パワコン</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">状態と全景画像を入力してください。</p>
            <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">状態</p>
            <livewire:power-converter-status :report="$report" />
            <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mt-4 mb-4">パワコン全景（最大6件）</p>
            @for ($i = 1; $i <= 6; $i++)
            <div class="mb-4">
                <label class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">パワコン全景{{ $i }}</label>
                <livewire:upload-power-converter-photo :report="$report" :index="$i" :key="'power-converter-photo-'.$report->id.'-'.$i" />
            </div>
            @endfor
        </div>

        {{-- アンカー: 配管パテ --}}
        <div id="pipe-putty" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow mb-4 scroll-mt-24">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">配管パテ</h2>
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">状態と画像を入力してください。</p>
            <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-4">状態</p>
            <livewire:pipe-putty-status :report="$report" />
            <p class="block text-base font-medium text-gray-700 dark:text-gray-300 mt-4 mb-4">配管パテ画像（最大6件）</p>
            @for ($i = 1; $i <= 6; $i++)
            <div class="mb-4">
                <label class="block text-base font-medium text-gray-700 dark:text-gray-300 mb-2">配管パテ画像{{ $i }}</label>
                <livewire:upload-pipe-putty-photo :report="$report" :index="$i" :key="'pipe-putty-photo-'.$report->id.'-'.$i" />
            </div>
            @endfor
        </div>
        <div>
            <div class="flex justify-between">
                <a href="{{ route('inspection.second', ['report' => $report->id]) }}" class="w-1/2 bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center mr-2">
                    前へ
                </a>
                <a href="{{ route('inspection.forth', ['report' => $report->id]) }}" class="w-1/2 bg-indigo-600 dark:bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 text-center">
                    次へ
                </a>
            </div>
        </div>
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

    @vite('resources/js/app.js')
</body>
</html>
