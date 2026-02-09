<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>受付一覧</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f4f8;
            padding: 32px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            color: #1a202c;
            margin-bottom: 24px;
            font-size: 28px;
        }
        .back {
            display: inline-block;
            color: #4299e1;
            text-decoration: none;
            margin-bottom: 16px;
            font-size: 14px;
        }
        .back:hover { text-decoration: underline; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        th {
            background: #4299e1;
            color: #fff;
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
        }
        td {
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #4a5568;
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f7fafc; }
        .empty {
            text-align: center;
            padding: 48px;
            color: #a0aec0;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }
        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            background: #ebf8ff;
            color: #2b6cb0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .header h1 {
            margin-bottom: 0;
        }
        .logout-btn {
            padding: 8px 16px;
            background: #e53e3e;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .logout-btn:hover { background: #c53030; }
        .delete-btn {
            padding: 4px 12px;
            background: none;
            color: #e53e3e;
            border: 1px solid #e53e3e;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .delete-btn:hover {
            background: #e53e3e;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('reception.form') }}" class="back">&larr; 受付画面に戻る</a>
        <div class="header">
            <h1>受付一覧</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">ログアウト</button>
            </form>
        </div>

        @if($receptions->isEmpty())
            <div class="empty">まだ受付がありません</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>名前</th>
                        <th>会社名</th>
                        <th>ご用件</th>
                        <th>受付時刻</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receptions as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->company }}</td>
                            <td>
                                <span class="badge">
                                    @switch($r->purpose)
                                        @case('meeting') 打ち合わせ @break
                                        @case('interview') 面接 @break
                                        @case('delivery') 納品・受取 @break
                                        @case('other') その他 @break
                                    @endswitch
                                </span>
                            </td>
                            <td>{{ $r->created_at->format('Y/m/d H:i') }}</td>
                            <td>
                                <form method="POST" action="{{ route('reception.destroy', $r) }}" onsubmit="return confirm('この受付を削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
