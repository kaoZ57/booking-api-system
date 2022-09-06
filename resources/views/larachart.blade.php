<!-- geochart.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laravel GeoChart Example</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div id="poll_div"></div>
        {!! $lava->render('BarChart', 'Votes', 'poll_div') !!}
    </div>

</body>

</html>
