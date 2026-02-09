<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お呼び出し中</title>
    <meta http-equiv="refresh" content="5;url={{ route('reception.form') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #2b6cb0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }
        .container {
            text-align: center;
            padding: 48px;
        }
        .check {
            font-size: 64px;
            margin-bottom: 24px;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 16px;
        }
        .info {
            font-size: 20px;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        .time {
            font-size: 16px;
            opacity: 0.7;
            margin-top: 24px;
        }
        .redirect {
            font-size: 14px;
            opacity: 0.6;
            margin-top: 32px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="check">&#x2705;</div>
        <h1>受付完了</h1>
        <p class="info">{{ $reception->name }} 様（{{ $reception->company }}）</p>
        <p class="info">ただいまお呼び出ししております</p>
        <p class="info">ご用件：
            @switch($reception->purpose)
                @case('meeting') 打ち合わせ @break
                @case('interview') 面接 @break
                @case('delivery') 納品・受取 @break
                @case('other') その他 @break
            @endswitch
        </p>
        <p class="time">受付時刻：{{ $reception->created_at->format('H:i') }}</p>
        <p class="redirect">5秒後に受付画面に戻ります...</p>
    </div>
</body>
</html>
