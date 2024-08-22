@extends('layouts.app')

@section('content')
<div id="todo-app" class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>PHP - Simple To Do List App</h2>
        </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="input-group mb-3">
                    <input type="text" id="task-title" class="form-control" placeholder="Enter a new task">
                    <div class="input-group-append mx-2">
                        <button id="add-task" class="btn btn-primary">Add Task</button>
                    </div>
                </div>
            </div>
        </div>
   

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Completed</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="task-list">
                    @foreach ($todos as $todo)
                        <tr data-id="{{ $todo->id }}">
                            <td>
                                <input type="checkbox" class="complete-task" {{ $todo->is_completed ? 'checked' : '' }}>
                            </td>
                            <td>{{ $todo->title }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-task"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button id="show-all" class="btn btn-secondary mt-3">Show All Tasks</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add Task
        $('#add-task').click(function() {
            var title = $('#task-title').val();

            $.ajax({
                url: '{{ route("todos.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: title
                },
                success: function(todo) {
                    $('#task-list').append('<tr data-id="' + todo.id + '">' +
                        '<td><input type="checkbox" class="complete-task"></td>' +
                        '<td>' + todo.title + '</td>' +
                        '<td><button class="btn btn-danger btn-sm delete-task">Delete</button></td>' +
                        '</tr>');
                    $('#task-title').val('');
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.responseJSON.error || 'Something went wrong! Task Name is required. !!',
                    });
                }
            });
        });

        // Complete Task
        $(document).on('click', '.complete-task', function() {
            var id = $(this).closest('tr').data('id');

            $.post('{{ url("todos/complete") }}/' + id, {
                _token: '{{ csrf_token() }}'
            }, function() {
                $('tr[data-id="' + id + '"]').remove();
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to mark task as completed.',
                });
            });
        });

        // Delete Task
        $(document).on('click', '.delete-task', function() {
            var taskRow = $(this).closest('tr');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to recover this task!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = taskRow.data('id');

                    $.ajax({
                        url: '{{ url("todos") }}/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            taskRow.remove();
                            Swal.fire(
                                'Deleted!',
                                'Your task has been deleted.',
                                'success'
                            );
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Failed to delete the task.',
                            });
                        }
                    });
                }
            });
        });

        // Show All Tasks
        $('#show-all').click(function() {
            $.get('{{ route("todos.showAll") }}', function(todos) {
                $('#task-list').empty();
                $.each(todos, function(index, todo) {
                    $('#task-list').append('<tr data-id="' + todo.id + '">' +
                        '<td><input type="checkbox" class="complete-task"' + (todo.is_completed ? 'checked' : '') + '></td>' +
                        '<td>' + todo.title + '</td>' +
                        '<td><button class="btn btn-danger btn-sm delete-task">Delete</button></td>' +
                        '</tr>');
                });
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to load tasks.',
                });
            });
        });
    });
</script>

@endpush
