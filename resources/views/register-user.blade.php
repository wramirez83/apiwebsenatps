<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <main class="container mt-5">
       @include('errors')
        @if (session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif

        <form action="{{Route('register')}}" method="post" class="container mt-8">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nameuser" placeholder="Nombre" name="nameuser" value="{{ old('nameuser') }}">
                <label for="nameuser">Nombre Completo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{ old('email') }}">
                <label for="floatingInput">Correo Electrónico</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Clave</label>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto pt-5">
                <button type="submit" class="btn btn-primary">Guardar</button>

            </div>
        </form>
    </main>
</body>

</html>
