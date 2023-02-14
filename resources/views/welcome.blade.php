<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                    <tr id="list_todo_{{ $todo->id }}">
                        <td>{{ $todo->id }}</td>
                        <td>{{ $todo->name }}</td>
                        <td>
                            <button class="btn btn-success btn-sm" type="button" id="update_todo"
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

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#add_todo').on('click', function() {
            $('#modal_todo').modal('show');
        });
    </script>
</body>

</html>
