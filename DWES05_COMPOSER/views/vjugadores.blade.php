@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
    @if (isset($mensaje)) <!--si está configurada la variable mensaje-->
        <div class="alert alert-success h-100 mt-3"> <!-- sacamos cuadrito verde con mensaje de éxito -->
            <p>{{$mensaje}}</p>
        </div>
    @endif
    <!--código de nuevo jugador, que es un enlace a la página fcrear.php-->
    <a href="fcrear.php" class="btn btn-success mt-2 mb-2"><i class="fa fa-plus"></i>Nuevo jugador</a>
    <!--código para generar la tabla-->
    <table class="table table-striped table-dark">
        <thead>
            <!--cabecera-->
            <tr class="text-center" style="font-width: bold; font-size: 1.1rem">
                <th scope="col">Nombre completo</th>
                <th scope="col">Posición</th>
                <th scope="col">Dorsal</th>
                <th scope="col">Código de Barras</th>
            </tr>
        </thead>
        <tbody>
            <!--para cada fila, un bucle foreach-->
        @foreach($jugadores as $item)<!--recorre todos los jugadores-->
            <tr class="text-center">
                <th scope="row">{{$item->apellidos.", ".$item->nombre}}</th>
                <td>{{$item->posicion}}</td>
                @if(isset($item->dorsal))
                    <td>{{$item->dorsal}}</td>
                @else
                    <td>Sin Asignar</td>
                @endif
                <!--celda para el código de barras-->
                <td class="d-flex justify-content-center">@php echo $d->getBarcodeHTML($item->barcode,'EAN13',2,33,'white') @endphp</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection