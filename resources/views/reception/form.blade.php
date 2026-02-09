<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>受付</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 48px;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 480px;
        }
        h1 {
            text-align: center;
            color: #1a202c;
            margin-bottom: 32px;
            font-size: 28px;
        }
        label {
            display: block;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: border-color 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #4299e1;
        }
        .error {
            color: #e53e3e;
            font-size: 13px;
            margin-top: -16px;
            margin-bottom: 16px;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #4299e1;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover { background: #3182ce; }
        .link {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #4299e1;
            text-decoration: none;
            font-size: 14px;
        }
        .link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>受付</h1>
        <form method="POST" action="{{ route('reception.store') }}">
            @csrf
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="山田 太郎" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror

            <label for="company">会社名</label>
            <input type="text" id="company" name="company" value="{{ old('company') }}" placeholder="株式会社サンプル" required>
            @error('company') <p class="error">{{ $message }}</p> @enderror

            <label for="purpose">ご用件</label>
            <select id="purpose" name="purpose" required>
                <option value="" disabled {{ old('purpose') ? '' : 'selected' }}>選択してください</option>
                <option value="meeting" {{ old('purpose') == 'meeting' ? 'selected' : '' }}>打ち合わせ</option>
                <option value="interview" {{ old('purpose') == 'interview' ? 'selected' : '' }}>面接</option>
                <option value="delivery" {{ old('purpose') == 'delivery' ? 'selected' : '' }}>納品・受取</option>
                <option value="other" {{ old('purpose') == 'other' ? 'selected' : '' }}>その他</option>
            </select>
            @error('purpose') <p class="error">{{ $message }}</p> @enderror

            <button type="submit">受付する</button>
        </form>
        @auth
            <a href="{{ route('reception.index') }}" class="link">受付一覧を見る</a>
        @endauth
    </div>
</body>
</html>
