@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Adultos Mayores</h1>
  <a href="{{ route('wizard.paso1') }}" class="btn btn-primary mb-3">Registrar Nuevo</a>
  <table class="table">
    <thead>
      <tr>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($adultos as $adulto)
        <tr>
          <td>{{ $adulto->dni }}</td>
          <td>{{ $adulto->nombres }}</td>
          <td>{{ $adulto->apellidos }}</td>
          <td>
            <a href="{{ route('adultos.show', $adulto->id) }}" class="btn btn-info btn-sm">Ver</a>
            <a href="{{ route('adultos.edit', $adulto->id) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('adultos.destroy', $adulto->id) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection