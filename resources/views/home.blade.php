<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <form action="{{ Route('sign.in') }}" method="POST">
        @csrf
        <label for="exampleInputEmail1" class="form-label">ชื่อเว็บไซต์</label>
        <input type="string" class="form-control" id="name" aria-describedby="emailHelp" name="name">
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <p>you key = @if ($response)
            {{ $response }}
        @endif
    </p>
    {{-- <p>{{ $response }}</p> --}}


</body>

</html>
