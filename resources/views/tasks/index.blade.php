<div class="table">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Descripción</th>
            <th scope="col">Status</th>
            <th scope="col">Fecha máxima de cierre</th>
            <th>Usuario asignado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="{{$task->is_expired ? 'bg-danger text-white' : ''}}">
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->description}}</td>
                <td>{{$task->status}}</td>
                <td>{{$task->date_max}}</td>
                <td>{{$task->users ? $task->users->name : null}}</td>
                <td>
                    <a href="/tasks/{{$task->id}}/edit" class="btn btn-success">Take</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
