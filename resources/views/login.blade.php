<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
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
        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            transition: border-color 0.2s;
        }
        input:focus {
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
        <h1>ログイン</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror

            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="パスワード" required>
            @error('password') <p class="error">{{ $message }}</p> @enderror

            <button type="submit">ログイン</button>
        </form>
        <a href="{{ route('reception.form') }}" class="link">受付画面に戻る</a>
    </div>
</body>
</html>
