<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>{{ $report->reported_at }}_{{ $report->plant_name }}_太陽光発電所メンテナンス点検報告書</title>
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
h3 {
    font-size: 20px;
    text-align: left;
    margin: 0;
    padding: 0;
    padding-left: 29px;
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
    box-sizing: border-box; /* 枠線を含めたサイズ調整 */
}
.photo-table p {
    width: 90%; /* 横幅を調整 */
    height: 200px; /* 高さを200pxに拡大 */
    margin: 0 auto; /* 中央揃え */
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
    width: 30px;
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
                <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                    @if (!empty($report->signboard_photo_path))
                        <img src="{{ storage_path('app/public/' . $report->signboard_photo_path) }}" alt="看板写真">
                    @else
                        <p>【看板画像】</p>
                    @endif
                </div>
            </td>
            <td></td> <!-- 空白スペース -->
        </tr>
    </table>
    <table class="photo-table">
        @for ($i = 1; $i <= 4; $i += 2)
            <tr>
                <td>
                    <strong>南から{{ $i }}列目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->rowPhotos->firstWhere('row_number', $i))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="南から{{ $i }}列目">
                        @else
                            <p>【南から{{ $i }}列目画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong>南から{{ $i + 1 }}列目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->rowPhotos->firstWhere('row_number', $i + 1))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="南から{{ $i + 1 }}列目">
                        @else
                            <p>【南から{{ $i + 1 }}列目画像】</p>
                        @endif
                    </div>
                </td>
            </tr>
        @endfor
    </table>

    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 2ページ目 点検内容 -->
    <h2>除草剤散布</h2>
    <table class="photo-table">
        @for ($i = 5; $i <= 10; $i += 2)
            <tr>
                <td>
                    <strong>南から{{ $i }}列目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->rowPhotos->firstWhere('row_number', $i))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="南から{{ $i }}列目">
                        @else
                            <p>【南から{{ $i }}列目画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong>南から{{ $i + 1 }}列目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->rowPhotos->firstWhere('row_number', $i + 1))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="南から{{ $i + 1 }}列目">
                        @else
                            <p>【南から{{ $i + 1 }}列目画像】</p>
                        @endif
                    </div>
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
                    <strong>東側通路{{ $i }}</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->eastPathPhotos->get($i - 1))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="東側通路{{ $i }}画像">
                        @else
                            <p>【東側通路{{ $i }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong>東側通路{{ $i + 1 }}</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->eastPathPhotos->get($i))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="東側通路{{ $i + 1 }}画像">
                        @else
                            <p>【東側通路{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
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
                    <strong>南側通路{{ $i }}</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->southPathPhotos->get($i - 1))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="南側通路{{ $i }}画像">
                        @else
                            <p>【南側通路{{ $i }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong>南側通路{{ $i + 1 }}</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo = $report->southPathPhotos->get($i))
                            <img src="{{ storage_path('app/public/' . $photo->photo_path) }}" alt="南側通路{{ $i + 1 }}画像">
                        @else
                            <p>【南側通路{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
                </td>
            </tr>
        @endfor
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 4ページ目 除草に関する特記事項 -->
    <h2>除草に関する特記事項</h2>
    <table class="photo-table">
        @foreach ($report->weedingNotes as $note)
            <tr>
                <td>
                    <strong>{{ $note->title ?? '特記事項'.$i }}</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if (!empty($note->photo_path))
                            <img src="{{ storage_path('app/public/' . $note->photo_path) }}" alt="特記事項{{ $i }}写真">
                        @else
                            <p>【特記事項{{ $i }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong style="color: #fff">dummy</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box; min-height: 210px;">
                        <p style="word-wrap: break-word; word-break: break-word; white-space: pre-line;text-align:{{ $note->description ? 'left': 'center' }}">{{ $note->description ?? '【特記事項'.$i.'内容】' }}</p>
                    </div>
                </td>
            </tr>
        @endforeach
        @if ($report->specialNotes->isEmpty())
            <tr>
                <td colspan="2"><p>【特記事項がありません】</p></td>
            </tr>
        @endif
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
                <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                    @if ($report->inside_junction_box_photo)
                        <img src="{{ storage_path('app/public/' . $report->inside_junction_box_photo) }}" alt="集電箱画像" />
                    @else
                        <p>【集電箱画像】</p>
                    @endif
                </div>
            </td>
            <td>
                <strong>集電箱内</strong>
                <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                    @if ($report->inside_junction_box_photo)
                        <img src="{{ storage_path('app/public/' . $report->inside_junction_box_photo) }}" alt="集電箱内画像" />
                    @else
                        <p>【集電箱内画像】</p>
                    @endif
                </div>
            </td>
        </tr>
        @for ($i = 1; $i <= 4; $i += 2)
            <tr>
                <td>
                    <strong>パワコン{{ $i }}台目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo1 = $report->powerConverters->firstWhere('index', $i))
                            <img src="{{ storage_path('app/public/' .  $photo1->photo_path) }}" alt="パワコン{{ $i }}画像" />
                        @else
                            <p>【パワコン{{ $i }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong>パワコン{{ $i + 1 }}台目</strong>   
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo2 = $report->powerConverters->firstWhere('index', $i + 1))
                            <img src="{{ storage_path('app/public/' .  $photo2->photo_path) }}" alt="パワコン{{ $i + 1 }}画像" />
                        @else
                            <p>【パワコン{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
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
                    <strong>パワコン{{ $i }}台目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo1 = $report->powerConverters->firstWhere('index', $i))
                            <img src="{{ storage_path('app/public/' .  $photo1->photo_path) }}" alt="パワコン{{ $i }}画像" />
                        @else
                            <p>【パワコン{{ $i }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong>パワコン{{ $i + 1 }}台目</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo2 = $report->powerConverters->firstWhere('index', $i + 1))
                            <img src="{{ storage_path('app/public/' .  $photo2->photo_path) }}" alt="パワコン{{ $i + 1 }}画像" />
                        @else
                            <p>【パワコン{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
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
        @for ($i = 0; $i < 6 ; $i += 2)
            <tr>
                <td><div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                    @if (isset($report->powerConverterOverviewPhotos[$i]))
                        <img src="{{ storage_path('app/public/' . $report->powerConverterOverviewPhotos[$i]->photo_path) }}" alt="パワコン全景{{ $i + 1 }}画像" class="h-32 object-contain rounded-md">
                    @else
                        <p>【パワコン全景{{ $i + 1 }}画像】</p>
                    @endif
                    </div>
                </td>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                    @if (isset($report->powerConverterOverviewPhotos[$i + 1]))
                        <img src="{{ storage_path('app/public/' . $report->powerConverterOverviewPhotos[$i + 1]->photo_path) }}" alt="パワコン全景{{ $i + 2 }}画像" class="h-32 object-contain rounded-md">
                    @else
                        <p>【パワコン全景{{ $i + 2 }}画像】</p>
                    @endif
                    </div>
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
        @for ($i = 0; $i < 6; $i += 2)
            <?php $pipe1 = $report->pipePuttyPhotos->get($i); ?>
            <?php $pipe2 = $report->pipePuttyPhotos->get($i + 1); ?>
            <tr>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($pipe1 && $pipe1->photo_path)
                            <img src="{{ storage_path('app/public/' . $pipe1->photo_path) }}" alt="配管パテ{{ $i + 1 }}画像">
                        @else
                            <p>【配管パテ{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($pipe2 && $pipe2->photo_path)
                            <img src="{{ storage_path('app/public/' . $pipe2->photo_path) }}" alt="配管パテ{{ $i + 2 }}画像">
                        @else
                            <p>【配管パテ{{ $i + 2 }}画像】</p>
                        @endif
                    </div>
                </td>
            </tr>
        @endfor
    </table>

    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 9ページ目 目視点検 パネルアレイ -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <strong>パネルアレイ</strong>
            </td>
        </tr>
        @for ($i = 0; $i < 6; $i += 2)
            <?php $panel1 = $report->panelArrayPhotos->get($i); ?>
            <?php $panel2 = $report->panelArrayPhotos->get($i + 1); ?>
            <tr>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($panel1 && $panel1->photo_path)
                            <img src="{{ storage_path('app/public/' . $panel1->photo_path) }}" alt="パネルアレイ{{ $i + 1 }}画像">
                        @else
                            <p>【パネルアレイ{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($panel2 && $panel2->photo_path)
                            <img src="{{ storage_path('app/public/' . $panel2->photo_path) }}" alt="パネルアレイ{{ $i + 2 }}画像">
                        @else
                            <p>【パネルアレイ{{ $i + 2 }}画像】</p>
                        @endif
                    </div>
                </td>
            </tr>
        @endfor
    </table>

    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 10ページ目 目視点検 パネル汚れの有無 -->
    <h2>目視点検</h2>
    <table class="photo-table">
        <tr>
            <td colspan="2">
                <strong>パネル汚れの有無</strong>
            </td>
        </tr>
        @for ($i = 0; $i < 6; $i += 2)
            <tr>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo1 = $report->panelConditionPhotos->get($i))
                            <img src="{{ storage_path('app/public/' . $photo1->photo_path) }}" alt="パネル汚れ{{ $i + 1 }}画像">
                        @else
                            <p>【パネル汚れ{{ $i + 1 }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($photo2 = $report->panelConditionPhotos->get($i + 1))
                            <img src="{{ storage_path('app/public/' . $photo2->photo_path) }}" alt="パネル汚れ{{ $i + 2 }}画像">
                        @else
                            <p>【パネル汚れ{{ $i + 2 }}画像】</p>
                        @endif
                    </div>
                </td>
            </tr>
        @endfor
        @if ($report->panelConditionPhotos->isEmpty())
            <tr>
                <td colspan="2"><p>【パネル汚れ画像がありません】</p></td>
            </tr>
        @endif
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif

    <div style="page-break-after: always;"></div>

    <!-- 11ページ目 特記事項 -->
    <h2>特記事項</h2>
    <table class="photo-table">
        @for ($i = 1; $i <= 3; $i++) <!-- ループを3つまでに制限 -->
            <?php $note = $report->specialNotes->get($i - 1); ?>
            <tr>
                <td>
                    <strong>{{ $note?->title ?? '特記事項'.$i }}</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;">
                        @if ($note?->photo_patj)
                            <img src="{{ storage_path('app/public/' . $note->photo_path) }}" alt="特記事項{{ $i }}画像">
                        @else
                            <p>【特記事項{{ $i }}画像】</p>
                        @endif
                    </div>
                </td>
                <td>
                    <strong style="color:#FFF">dummy</strong>
                    <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;height:210px">
                        <p style="word-wrap: break-word; word-break: break-word; white-space: pre-line;text-align:{{ $note->description ? 'left': 'center' }}">{{ $note->description ?? '【特記事項内容】' }}</p>
                    </div>
                </td>
            </tr>
        @endfor
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
                <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box;height:800px">
                    <p style="word-wrap: break-word; word-break: break-word; white-space: pre-line; text-align:{{ $report->remarks ? 'left': 'center' }}">{{ $report->remarks ?? '【備考内容】' }}</p>
                </div>
            </td>
        </tr>
    </table>

    <!-- 下中央のロゴ -->
    @if ($logoBase64)
        <img src="data:image/jpg;base64,{{ $logoBase64 }}" alt="ロゴ" class="logo-bottom">
    @endif
</body>
</html>
