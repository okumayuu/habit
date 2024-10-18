<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habit - Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 10px;
            color: #4CAF50;
        }
        p {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
        }
        .button-group {
            margin-top: 30px;
        }
        button {
            font-size: 18px;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-button {
            background-color: #4CAF50;
            color: white;
        }
        .signup-button {
            background-color: #2196F3;
            color: white;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to Habit</h1>
        <p>「Habit」は、あなたの目標達成をサポートするアプリです。習慣化したい行動を選び、日々の進捗を記録として投稿しましょう。<br>
        投稿に対してコメントをもらったり、「いいね！」でモチベーションを高めたり、フォロー機能で仲間とつながりながら、楽しく目標を追いかけることができます。</p>

        <div class="button-group">
            <!-- Login ボタン -->
            <button class="login-button" onclick="location.href='{{ route('login') }}'">Login</button>
            <!-- 新規登録ボタン -->
            <button class="signup-button" onclick="location.href='{{ route('register') }}'">新規登録</button>
        </div>
    </div>

</body>
</html>
