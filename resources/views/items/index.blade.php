<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cardápio</h1>



    <ul>
    @foreach($items as $item)
        <li>
            {{ $item->name }} - R$ {{ $item->price }}
        </li>
    @endforeach
    </ul>   
</body>
</html>