<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>作業報告書</title>
<style>
@font-face {
    font-family: ipag;
    font-style: normal;
    font-weight: normal;
    src: url('{{ storage_path('fonts/ipag.ttf') }}');
}
@font-face{
    font-family: ipag;
    font-style: bold;
    font-weight: bold;
    src:url('{{ storage_path('fonts/ipag.ttf')}}');
}
body {
    font-family: ipag;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    position: relative;
    height: 100vh;
}
h1 {
    font-size: 32px;
    text-align: center;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin: 0;
}
.logo {
    position: absolute;
    top: 10%;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: auto;
}
.basic-info {
    position: absolute;
    bottom: 10%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    font-size: 14px;
}
.basic-info table {
    width: auto;
    margin: 0 auto;
    border-collapse: collapse;
}
.basic-info th {
    font-weight: bold;
    text-align:justify;
    text-align-last:justify;
    padding: 5px 10px;
}
.basic-info td {
    padding: 5px 10px;
    border: none;
    text-align: left;
}
.basic-info td:last-child {
    padding-top: 10px;
}
p {
    font-size: 14px;
    margin: 5px 0;
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.table th, .table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: left;
}
.table th {
    background-color: #f2f2f2;
}
.photo-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 20px;
}
.photo-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}
.photo-item {
    flex-basis: 50%; /* 各アイテムの幅 */
}
.photo-item img {
    max-width: 100%;
    max-height: 150px;
    margin-top: 10px;
    border: 1px solid #000;
}
.photo-table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}
.photo-table td {
    width: 50%;
    text-align: center;
    vertical-align: top;
    padding: 10px;
    border: none; /* 罫線を削除 */
}
.photo-table img {
    max-width: 100%;
    max-height: 200px; /* 高さを200pxに拡大 */
    margin-top: 10px;
}
.photo-table p {
    border: 1px solid #000; /* ボーダーを追加 */
    width: 90%; /* 横幅を調整 */
    height: 200px; /* 高さを200pxに拡大 */
    margin: 10px auto; /* 中央揃え */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    box-sizing: border-box;
    text-align: center;
    position: relative;
}
.photo-table td strong {
    display: block;
    text-align: left; /* 左寄せ */
    margin-left: 20px;
}
h2 {
    margin-left: 30px; /* 左に余白を追加 */
}
.logo-bottom {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: auto;
}
</style>
</head>
<body>
    <!-- ロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo">
    @endif

    <!-- タイトル -->
    <h1>【{{ $report->plant_name }}】太陽光発電所<br />メンテナンス点検報告書</h1>

    <!-- 基本情報 -->
    <div class="basic-info">
        <table>
            <tr>
                <th>発電所名</th>
                <td>{{ $report->plant_name }}</td>
            </tr>
            <tr>
                <th>物件住所</th>
                <td>{{ $report->property_address }}</td>
            </tr>
            <tr>
                <th>作業日</th>
                <td>{{ $report->worked_at }}</td>
            </tr>
            <tr>
                <th>天候</th>
                <td>{{ $report->weather }}</td>
            </tr>
            <tr>
                <th>点検報告日</th>
                <td>{{ $report->reported_at }}</td>
            </tr>
        </table>
    </div>

    <div style="page-break-after: always;"></div>

    <!-- 点検内容 -->
    <h2>除草剤散布</h2>
    <table class="photo-table">
        <tr>
            <td>
                <strong>看板</strong>
                @if ($report->signboard_photo_path)
                    <img src="{{ storage_path('app/public/' . $report->signboard_photo_path) }}" alt="看板写真">
                @else
                    <p>【看板画像】</p>
                @endif
            </td>
            <td></td> <!-- 空白スペース -->
        </tr>
        @for ($i = 1; $i <= 4; $i += 2)
            <tr>
                <td>
                    <strong>南から{{ $i }}列目</strong>
                    @if ($report->{'south_column_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'south_column_' . $i . '_photo_path'}) }}" alt="南から{{ $i }}列目">
                    @else
                        <p>【南から{{ $i }}列目画像】</p>
                    @endif
                </td>
                <td>
                    <strong>南から{{ $i + 1 }}列目</strong>
                    @if ($report->{'south_column_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'south_column_' . ($i + 1) . '_photo_path'}) }}" alt="南から{{ $i + 1 }}列目">
                    @else
                        <p>【南から{{ $i + 1 }}列目画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 2ページ目 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 3ページ目 点検内容 -->
    <h2>除草剤散布</h2>
    <table class="photo-table">
        @for ($i = 5; $i <= 10; $i += 2)
            <tr>
                <td>
                    <strong>南から{{ $i }}列目</strong>
                    @if ($report->{'south_column_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'south_column_' . $i . '_photo_path'}) }}" alt="南から{{ $i }}列目">
                    @else
                        <p>【南から{{ $i }}列目画像】</p>
                    @endif
                </td>
                <td>
                    <strong>南から{{ $i + 1 }}列目</strong>
                    @if ($report->{'south_column_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'south_column_' . ($i + 1) . '_photo_path'}) }}" alt="南から{{ $i + 1 }}列目">
                    @else
                        <p>【南から{{ $i + 1 }}列目画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 追加ページ 東側通路 -->
    <h2>除草剤散布</h2>
    <table class="photo-table">
        @for ($i = 1; $i <= 6; $i += 2)
            <tr>
                <td>
                    @if ($i === 1)
                        <strong>東側通路</strong>
                    @else
                        <br>
                    @endif
                    @if ($report->{'east_path_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'east_path_' . $i . '_photo_path'}) }}" alt="東側通路{{ $i }}画像">
                    @else
                        <p>【東側通路{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    <br>
                    @if ($report->{'east_path_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'east_path_' . ($i + 1) . '_photo_path'}) }}" alt="東側通路{{ $i + 1 }}画像">
                    @else
                        <p>【東側通路{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 追加ページ 南側通路 -->
    <h2>除草剤散布</h2>
    <table class="photo-table">
        @for ($i = 1; $i <= 6; $i += 2)
            <tr>
                <td>
                    @if ($i === 1)
                        <strong>南側通路</strong>
                    @else
                        <br>
                    @endif
                    @if ($report->{'south_path_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'south_path_' . $i . '_photo_path'}) }}" alt="南側通路{{ $i }}画像">
                    @else
                        <p>【南側通路{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    <br>
                    @if ($report->{'south_path_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'south_path_' . ($i + 1) . '_photo_path'}) }}" alt="南側通路{{ $i + 1 }}画像">
                    @else
                        <p>【南側通路{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 4ページ目 特記事項 -->
    <h2>除草に関する特記事項</h2>
    <table class="photo-table">
        @foreach (range(1, 3) as $i)
            <tr>
                <td>
                    <strong>特記事項{{ $i }}</strong>
                    @if ($report->{'special_note_photo_' . $i})
                        <img src="{{ storage_path('app/public/' . $report->{'special_note_photo_' . $i}) }}" alt="特記事項{{ $i }}写真">
                    @else
                        <p>【特記事項{{ $i }}写真】</p>
                    @endif
                </td>
                <td>
                    <br>
                    <p>
                        {{ $report->{'special_note_description_' . $i} ?? '【特記事項'.$i.'内容】' }}
                    </p>
                </td>
            </tr>
        @endforeach
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 5ページ目 目視点検 -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td>
                <strong>集電箱</strong>
                @if ($report->junction_box_photo_path)
                    <img src="{{ storage_path('app/public/' . $report->junction_box_photo_path) }}" alt="集電箱画像">
                @else
                    <p>【集電箱画像】</p>
                @endif
            </td>
            <td>
                <strong>集電箱内</strong>
                @if ($report->junction_box_inside_photo_path)
                    <img src="{{ storage_path('app/public/' . $report->junction_box_inside_photo_path) }}" alt="集電箱内画像">
                @else
                    <p>【集電箱内画像】</p>
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>パワコン10台分</strong>
            </td>
        </tr>
        @for ($i = 1; $i <= 4; $i += 2)
            <tr>
                <td>
                    @if ($report->{'power_conditioner_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'power_conditioner_' . $i . '_photo_path'}) }}" alt="パワコン{{ $i }}画像">
                    @else
                        <p>【パワコン{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    @if ($report->{'power_conditioner_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'power_conditioner_' . ($i + 1) . '_photo_path'}) }}" alt="パワコン{{ $i + 1 }}画像">
                    @else
                        <p>【パワコン{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 6ページ目 パワコン5-10 -->
    <h2>目視点検</h2>
    <table class="photo-table">
        @for ($i = 5; $i <= 10; $i += 2)
            <tr>
                <td>
                    @if ($report->{'power_conditioner_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'power_conditioner_' . $i . '_photo_path'}) }}" alt="パワコン{{ $i }}画像">
                    @else
                        <p>【パワコン{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    @if ($report->{'power_conditioner_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'power_conditioner_' . ($i + 1) . '_photo_path'}) }}" alt="パワコン{{ $i + 1 }}画像">
                    @else
                        <p>【パワコン{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 7ページ目 目視点検 パワコン全景 -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <strong>パワコン全景</strong>
            </td>
        </tr>
        @for ($i = 1; $i <= 6; $i += 2)
            <tr>
                <td>
                    @if ($report->{'power_conditioner_overview_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'power_conditioner_overview_' . $i . '_photo_path'}) }}" alt="パワコン全景{{ $i }}画像">
                    @else
                        <p>【パワコン全景{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    @if ($report->{'power_conditioner_overview_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'power_conditioner_overview_' . ($i + 1) . '_photo_path'}) }}" alt="パワコン全景{{ $i + 1 }}画像">
                    @else
                        <p>【パワコン全景{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 8ページ目 目視点検 配管パテ -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <strong>配管パテ</strong>
            </td>
        </tr>
        @for ($i = 1; $i <= 5; $i += 2)
            <tr>
                <td>
                    @if ($report->{'pipe_putty_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'pipe_putty_' . $i . '_photo_path'}) }}" alt="配管パテ{{ $i }}画像">
                    @else
                        <p>【配管パテ{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    @if ($report->{'pipe_putty_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'pipe_putty_' . ($i + 1) . '_photo_path'}) }}" alt="配管パテ{{ $i + 1 }}画像">
                    @else
                        <p>【配管パテ{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <div style="page-break-after: always;"></div>

    <!-- 9ページ目 目視点検 パネルアレイ -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <strong>パネルアレイ</strong>
            </td>
        </tr>
        @for ($i = 1; $i <= 5; $i += 2)
            <tr>
                <td>
                    @if ($report->{'panel_array_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'panel_array_' . $i . '_photo_path'}) }}" alt="パネルアレイ{{ $i }}画像">
                    @else
                        <p>【パネルアレイ{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    @if ($report->{'panel_array_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'panel_array_' . ($i + 1) . '_photo_path'}) }}" alt="パネルアレイ{{ $i + 1 }}画像">
                    @else
                        <p>【パネルアレイ{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <div style="page-break-after: always;"></div>

    <!-- 10ページ目 目視点検 パネル汚れの有無 -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <strong>パネル汚れの有無</strong>
            </td>
        </tr>
        @for ($i = 1; $i <= 5; $i += 2)
            <tr>
                <td>
                    @if ($report->{'panel_dirt_' . $i . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'panel_dirt_' . $i . '_photo_path'}) }}" alt="パネル汚れ{{ $i }}画像">
                    @else
                        <p>【パネル汚れ{{ $i }}画像】</p>
                    @endif
                </td>
                <td>
                    @if ($report->{'panel_dirt_' . ($i + 1) . '_photo_path'})
                        <img src="{{ storage_path('app/public/' . $report->{'panel_dirt_' . ($i + 1) . '_photo_path'}) }}" alt="パネル汚れ{{ $i + 1 }}画像">
                    @else
                        <p>【パネル汚れ{{ $i + 1 }}画像】</p>
                    @endif
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 11ページ目 特記事項 -->
    <h2>特記事項</h2>
    <table class="photo-table">
        @foreach (range(1, 3) as $i)
            <tr>
                <td>
                    <strong>特記事項{{ $i }}</strong>
                    @if ($report->{'additional_note_photo_' . $i})
                        <img src="{{ storage_path('app/public/' . $report->{'additional_note_photo_' . $i}) }}" alt="特記事項{{ $i }}写真">
                    @else
                        <p>【特記事項{{ $i }}写真】</p>
                    @endif
                </td>
                <td>
                    <br>
                    <p>
                        {{ $report->{'additional_note_description_' . $i} ?? '【特記事項'.$i.'内容】' }}
                    </p>
                </td>
            </tr>
        @endforeach
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 12ページ目 備考欄 -->
    <h2>備考</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <p style="height: 400px; border: 1px solid #000; display: flex; align-items: center; justify-content: center;">
                    【備考内容】
                </p>
            </td>
        </tr>
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif
</body>
</html>
