<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Word</title>
</head>
<body>
    <h2>PHP Word</h2>
    <form action="{{ route('word.index') }}" method="post">
        <div class="form-group">
            @csrf
            <input type="text" name="input">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>