<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax CRUD</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mt-3">
        <!-- The Modal Button -->
        <button type="button" class="btn btn-primary" id="add_todo"> Add To Do </button>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Sr No#</th>
                    <th>To do Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="list_todo">
                @foreach ($todos as $todo)
                    <tr id="row_todo_{{ $todo->id }}">
                        <td>{{ $todo->id }}</td>
                        <td>{{ $todo->name }}</td>
                        <td class="">
                            <button class="btn btn-success btn-sm" type="button" id="edit_todo"
                                data-id="{{ $todo->id }}">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" type="button" id="delete_todo"
                                data-id="{{ $todo->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" id="modal_todo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" method="POST" id="form_todo">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title"></h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input name="name" type="text" class="form-control" id="name_todo"
                                placeholder="Enter Todo Name">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $('#add_todo').on('click', function() {
            $('#form-todo').trigger('reset');
            $('#modal_title').html('Add todo');
            $('#modal_todo').modal('show');
        });

        // ajax code for editing todo
        $('body').on('click', '#edit_todo', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.post('todos/' + id + '/edit', function(res) {
                $('#modal_title').html('Edit todo');
                $('#id').val(res.id);
                $('#name_todo').val(res.name);
                $('#modal_todo').modal('show');
            });
        });

        // ajax code for deleting todo
        $('body').on('click', '#delete_todo', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.delete('todos/' + id + '/delete', function(res) {
                $('#id').val(res.id);
                confirm('Are you sure you want to delete this todo?');
            });

            $ajax({
                type: 'DELETE',
                url: 'todos/' + id + '/delete',
            }.done(function(res) {
                $('#row_todo_' + id).remove();
            }));
        });

        $('form').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name_todo').val();
            var id = $('#id').val();

            $.ajax({
                type: 'POST',
                url: '/todos/store',
                data: $('#form_todo').serialize(),
                type: 'POST',
            }).done(function(res) {
                var row = '<tr id="row_todo' + res.id + '">';
                row += '<td>' + res.id + '</td>';
                row += '<td>' + res.name + '</td>';
                row += '<td>' + '<button class="btn btn-success btn-sm" type="button" id="edit_todo"' +
                    res.id + '> Edit </button>' + ' ' +
                    '<button class="btn btn-danger btn-sm" type="button" id="delete_todo"' +
                    res.id + '> Delete </button>' + '</td>';

                if ($('#id').val()) {
                    $('#row_todo_' + res.id).replaceWith(row);
                } else {
                    $('#list_todo').prepend(row);
                }

                $('#form').trigger('reset');
                $('#modal_todo').modal('hide');
            });
        });
    </script>
</body>

</html>
