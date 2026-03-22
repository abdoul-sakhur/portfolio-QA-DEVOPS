<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px; color: #333;">
    <h2>Nouveau message de contact</h2>
    <p><strong>Nom :</strong> {{ $data['name'] }}</p>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    @if(!empty($data['subject']))
        <p><strong>Sujet :</strong> {{ $data['subject'] }}</p>
    @endif
    <hr>
    <p>{{ $data['message'] }}</p>
</body>
</html>
