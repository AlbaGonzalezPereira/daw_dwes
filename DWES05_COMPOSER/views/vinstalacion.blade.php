@extends('plantillas.plantilla1')
@section('titulo')
    {{$titulo}}<!-- es similar a php echo $titulo; -->
@endsection
@section('encabezado')
    {{$encabezado}}
@endsection
@section('contenido')
    <div class="text-center">
        <a href="crearDatos.php" class="btn btn-success" style="font-size: 1.5rem;">
            <i class="fas fa-database"></i>Instalar datos
        </a>
    </div>
@endsection