<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Обратная связь</title>
</head>
<body>
<table border="0" width="600" cellpadding="0" cellspacing="0" align="center" style="background: #ffffff">
    <tbody>
    <tr>
        <td style="background: #703AF1; border-radius: 6px; padding-bottom: 20px; padding-left: 32px; padding-right: 32px; padding-top: 20px; text-align: center">
            <a href="https://aqua-box.uz" target="_blank">
                <img width="" height="50" src='{{ asset('assets/apple-touch-icon.png') }}'/>
            </a>
        </td>
    </tr>
    <tr>
        <td style="padding: 50px 32px 60px; font-family: sans-serif; font-size: 16px; line-height: 22px; color: #2E2D2F">
            <p>Категория: {{ $data['category'] }}</p>
            <p>Имя: {{ $data['name'] }}</p>
            <p>Номер: {{ $data['phone'] }}</p>
            <p>Город: {{ $data['city'] }}</p>
            <p>Сообщение: {{ $data['message'] }}</p>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

