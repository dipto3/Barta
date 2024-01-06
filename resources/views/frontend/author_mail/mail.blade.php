<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Comment created by:{{ $comment->user->name }}</h1>
    <p>Post : <br>{{ $comment->post->description }}</p>
</body>
</html>