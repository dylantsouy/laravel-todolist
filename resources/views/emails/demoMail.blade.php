<!DOCTYPE html>
<html>

<head>
    <title>Todo 期限通知</title>
</head>

<body>
    <p>Dear {{ $user_name }} 您好,</p>
    <p>期限通知:{{ $deadline }}</p>
    <h1>您設置的 {{ $todo_name }} 期限剩下 {{$num}} 天</h1>

</body>

</html>
