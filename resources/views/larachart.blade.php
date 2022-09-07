<!-- geochart.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Booking API</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        <div id="temps_div"></div>
        // With the lava object
        <?= $lava->render('LineChart', 'Temps', 'temps_div') ?>
    </div>

</body>

</html>
