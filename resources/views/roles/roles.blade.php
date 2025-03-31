<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
    <title>Roles</title>
    <style>
        .fade {
            transition: 0.5s;
        }
    </style>
</head>

<body>

    <x-principal>
        <div class="container-content">
            <div class="table-container">
                <div class="header d-flex justify-content-between align-items-center">
                    <h2>Labores Agregadas</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                        + Agregar Labor
                    </button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ejemplo</td>
                            <td>Descripción de ejemplo</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Agregar Labor -->
        <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Labor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <form action="{{ route('ruta.de.guardado') }}" method="POST"> --}}
                        @csrf
                        <div class="mb-3">
                            <label for="nombreLabor" class="form-label">Nombre de la Labor</label>
                            <input type="text" class="form-control" id="nombreLabor" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="descripcionLabor" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionLabor" name="descripcion"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-principal>

</body>

</html>
