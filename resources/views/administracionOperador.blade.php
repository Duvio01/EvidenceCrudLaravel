<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <title>Administracion Operadores</title>
</head>

<body>
    <h1>Administracion Operadores</h1>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createorder2">Crear
        Operador</button>
    <a class="btn btn-primary" href="{{ route('index')}}">Regresar</a>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($operators as $operator)
                        <tr>
                            <td>{{ $operator->id }}</td>
                            <td>{{ $operator->nombre }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editOrder"  data-bs-whatever="{{ $operator->nombre}}">Editar
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('operadores.update', ['operadore' => $operator->id]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal fade" id="editOrder" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Operador</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="col-md-11">
                                                        <label for="nameOperator" class="form-label">Nombre del operador</label>
                                                        <input type="text" class="form-control" id="nameOperator"
                                                            name="nameOperator" required>
                                                        <div class="invalid-feedback">
                                                            Por favor seleccionar una orden
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('operadores.destroy', $operator->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary" type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

<div class="modal fade" id="createorder2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Operador</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" method="POST" action="{{ route('operadores.store') }}">
                    @csrf
                    <div class="col-md-11">
                        <label for="nameOperator" class="form-label">Nombre Operador</label>
                        <input type="text" class="form-control" id="nameOperator" name="nameOperator" required>
                        <div class="invalid-feedback">
                            Por favor seleccionar una orden
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="editarorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Orden</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" method="POST"{{--  action="{{ route('tipoOrden.update', ) }}" --}}>
                    @csrf
                    <div class="col-md-11">
                        <label for="nameOrder" class="form-label">Nombre de la orden</label>
                        <input type="text" class="form-control" id="nameOrder" name="nameOrder" required>
                        <div class="invalid-feedback">
                            Por favor seleccionar una orden
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>

        </div>
    </div>
</div>

<script>
    const modalAssign = document.getElementById('editOrder')
    if (modalAssign) {
        modalAssign.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.
            console.log(recipient)
            // Update the modal's content.
            const modalBodyInput = modalAssign.querySelector('#nameOperator')

            modalBodyInput.value = recipient
        })
    }
</script>

</html>
