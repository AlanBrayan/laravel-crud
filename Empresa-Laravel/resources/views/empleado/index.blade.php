@extends('layouts.app')

@section('content')
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.min.css">

    <link rel="stylesheet" href="">

</head>

<body>

    <center>
        <h1>Empleados</h1>
    </center>

    <table class="table table-dark" style="width: 80%; margin-left:10%">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>
                    <img src=" {{ asset('storage').'/'. $empleado->foto }}" width="100px" height="100px"
                        class="img-thumbnail" alt="Cinque Terre">
                </td>

                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->app }}</td>
                <td>{{ $empleado->apm }}</td>
                <td>{{ $empleado->correo }}</td>
                <td>
                    <a href=" {{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning"
                        style="display: inline-block;">Editar</a>

                            |

                    <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" style="display: inline-block;">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-danger" onclick="return showSweetAlert(event)"
                            value="Borrar">
                    </form>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>


    <center>
        <a class="btn btn-primary" href="{{ url('empleado/create') }}" role="button">Nuevo</a>
    </center>



    @if (session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: true,
    })
    </script>



    @endif


    <script>
    function showSweetAlert(event) {
        event.preventDefault();
        swal({
                title: "¿Estás seguro?",
                text: "Una vez borrado, no podrás recuperar este registro!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    event.target.form.submit();
                } else {
                    swal({
                        text: "Cancelado con exito!"
                    })
                }
            });
    }
    </script>


</body>

</html>
@endsection