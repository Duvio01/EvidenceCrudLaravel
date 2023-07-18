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
    <title>Cam Colombia</title>
</head>

<body>
    <div class="container-fluid">
        <div style="text-align: center; margin: 17px 0px 52px 0px;">
            <h1>Administracion Ordenes de trabajo</h1>
        </div>

        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createOrder">Nueva
                Orden</button>
            <a href="{{ route('tipoOrden.index') }}" class="btn btn-primary">Administracion Ordenes</a>
            <a class="btn btn-primary" href="{{ route('operadores.index') }}">Administracion Operadores</a>
        </div>

        <div row style="margin: 45px 0px 11px 0px;">
            <form action="{{route('index')}}" method="POST" class="row">
                @method('GET')
                @csrf
                <div class="col-md-3">
                    <label for="fechaAsignacion" class="form-label">Fecha Asignacion</label>
                    <input type="date" class="form-control" id="searchFechaAsignacion" name="searchFechaAsignacion">
                </div>
                <div class="col-md-3">
                    <label for="searchOrder" class="form-label">Tipo de orden</label>
                    <select name="searchOrder" class="form-select" id="searchOrder">
                        <option value=""></option>
                        @foreach ($typeOrders as $typeOrder)
                            <option value={{ $typeOrder->id }}>{{ $typeOrder->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="searchOperador" class="form-label">Operadores</label>
                    <select name="searchOperador" id="searchOperador" class="form-select">
                        <option value=""></option>
                        @foreach ($operators as $operator)
                            <option value={{ $operator->id }}>{{ $operator->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 ">
                    <button class="btn btn-primary" style="width: 90%;margin-top: 31px;">Consultar</button>
                </div>
            </form>
        </div>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha Creacion</th>
                        <th scope="col">Fecha Asignacion</th>
                        <th scope="col">Fecha Ejecucion</th>
                        <th scope="col">Tipo de orden</th>
                        <th scope="col">Operador</th>
                        <th scope="col">Resultado</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Asignacion</th>
                        <th scope="col">Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->fecha_creacion }}</td>
                            <td>{{ $order->fecha_asignacion }}</td>
                            <td>{{ $order->fecha_ejecucion }}</td>
                            <td>{{ $order->tipo_orden }}</td>
                            <td>{{ $order->operador }}</td>
                            <td>{{ $order->descripcion }}</td>
                            <td>$ {{ number_format($order->valor, 2, ',', '.')  }}</td>
                            @if ($order->fecha_asignacion !== null)
                                <td>La tarea ya esta asignada</td>
                            @else
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#assignOrder" data-bs-whatever="{{ $order->id }}">Asignar
                                        Orden</button></td>
                            @endif
                            @if ($order->fecha_ejecucion !== null)
                                <td>La tarea ya fue ejecutada</td>
                            @else
                                <td><button @disabled(!$order->fecha_asignacion)  type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#resultOrder"
                                        data-bs-whatever="{{ $order }}">Resultado</button></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>


<!-- Modal createOrder-->
<div class="modal fade" id="createOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Orden</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" method="POST" action="{{ route('saveOrder') }}">
                    @csrf
                    <div class="col-md-11">
                        <label for="order" class="form-label">Tipo de orden de trabajo</label>
                        <select name="order" class="form-select" id="order" required>
                            <option selected disabled value=""></option>
                            @foreach ($typeOrders as $typeOrder)
                                <option value={{ $typeOrder->id }}>{{ $typeOrder->nombre }}</option>
                            @endforeach
                        </select>
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

<!-- Modal assignOrder-->
<div class="modal fade" id="assignOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" action="{{ route('saveAssign') }}" method="POST">
                    @csrf
                    <div class="col-md-11">
                        <label for="operador" class="form-label">Operadores</label>
                        <select name="operador" id="operador" class="form-select" required>
                            <option selected disabled value=""></option>
                            @foreach ($operators as $operator)
                                <option value={{ $operator->id }}>{{ $operator->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccionar un operador
                        </div>
                    </div>
                    <div class="col-md-11">
                        <label for="fechaAsignacion" class="form-label">Fecha Asignacion</label>
                        <input type="date" class="form-control" id="fechaAsignacion" name="fechaAsignacion"
                            required>
                    </div>
                    <input type="text" class="form-control" hidden name="id" id="recipient-name">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal assignOrder-->
<div class="modal fade" id="resultOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Resultado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" action="{{ route('saveResult') }}" method="POST">
                    @csrf
                    <div class="col-md-11">
                        <label for="operador" class="form-label">Operadores</label>
                        <select name="operador" id="operador" class="form-select" required>
                            <option selected disabled value=""></option>
                            @foreach ($operators as $operator)
                                <option value={{ $operator->id }}>{{ $operator->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Por favor seleccionar un operador
                        </div>
                    </div>
                    <div class="col-md-11">
                        <label for="fechaEjecutada" class="form-label">Fecha Ejecutada</label>
                        <input type="date" class="form-control" id="fechaEjecutada" name="fechaEjecutada"
                            required>
                    </div>
                    <div class="col-md-11">
                        <label for="resultado" class="form-label">Resultado</label>
                        <textarea class="form-control" name="resultado" id="resultado" cols="30" rows="2" required></textarea>
                    </div>
                    <div class="col-md-11">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="valor" name="valor" required>
                    </div>
                    <input type="text" class="form-control" hidden name="id" id="recipient-name">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <input type="text" hidden name='id' id='id'>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    const modalAssign = document.getElementById('assignOrder')
    if (modalAssign) {
        modalAssign.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content.
            const modalBodyInput = modalAssign.querySelector('#recipient-name')

            modalBodyInput.value = recipient
        })
    }

    let order = ''

    const modalAssign2 = document.getElementById('resultOrder')
    if (modalAssign2) {
        modalAssign2.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.
            order = JSON.parse(recipient)
            // Update the modal's content.
            const modalBodyInput = modalAssign2.querySelector('#id')

            modalBodyInput.value = order.id
        })
    }

    const inputDateAssign = document.querySelector('#fechaEjecutada')
    inputDateAssign.addEventListener('change', (event) => {
        let fecha1 = event.target.value
        let fecha2 = order.fecha_asignacion
        if (fecha2 < fecha1) {
            let inputDate = document.querySelector('#fechaEjecutada')
            inputDate.value = ''
            alert('La fecha de ejecucion no puede ser mayor a la fecha de asignacion')
        }
    })
</script>

</html>
