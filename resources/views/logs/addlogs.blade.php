@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Agregando logs') }} <a href="/home" class="btn btn-warning float-right">Volver</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Creado por</th>
                                <th scope="col">Fecha maxima de solucion</th>
                                <th scope="col">Descripcion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$task->user_created->name}}</td>
                                <td>{{$task->date_max}}</td>
                                <td>{{$task->description}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('logs.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción de la actividad</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                @include('alerts.errors', ['field' => 'description'])
                            </div>
                            <div class="mb-3">
                                <select class="form-control" aria-label="Default select example" name="action">
                                    <option value="-">Seleccione una accion</option>
                                    <option value="assing_task">Procesar tarea</option>
                                    <option value="close_task">Cerrar tarea</option>
                                </select>
                                @include('alerts.errors', ['field' => 'action'])
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="task_id" value="{{$task->id}}" />
                                <button class="btn btn-success float-right" type="submit">Grabar</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <h3>Logs</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Acción</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->action}}</td>
                                        <td>{{$log->description}}</td>
                                        <td>{{$log->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
