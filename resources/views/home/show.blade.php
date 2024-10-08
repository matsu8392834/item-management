<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>画像表示</title>
    <style>
        .box {
            width: 300px;
            height: 300px;
            border: 2px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 20px;
        }
        .box img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <h1>アップロードされた画像</h1>
    <div class="box">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $image->filename))) }}" alt="Uploaded Image">
    </div>
</body>
</html>