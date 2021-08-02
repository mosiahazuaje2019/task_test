@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Take Tasks') }} <a href="/home" class="btn btn-warning float-right">Volver</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('tasks.update',$task->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción de la tarea</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{$task->description}}</textarea>
                                @include('alerts.errors', ['field' => 'description'])
                            </div>
                            <div class="mb-3">
                                <label for="date_max">Fecha máxima para solucionar</label>
                                <input type="date" name="date_max" id="date_max" class="form-control" value="{{$task->date_max}}">
                                @include('alerts.errors', ['field' => 'date_max'])
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success float-right" type="submit">Grabar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
