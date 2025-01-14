@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
         <a href="{{ route('categories.create')}}" class="btn btn-outline-success btn-rounded waves-effect"><i class="fas fa-cogs pr-2" aria-hidden="true"></i>Add Category</a>
     </div>
    <div class="card card-default">
        <div class="card-header">Categories</div>
        <div class="card-body">
            @if ($categories->count() >0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name Category</th>
                        <th scope="col">Posts Count</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                        <td>{{ $category->posts->count() }}</td>
                            <td>
                            @auth
                                <a href="{{route('categories.edit', $category->id) }}" class="btn btn-outline-info waves-effect btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <button class="btn btn-outline-danger waves-effect btn-sm" onclick="handleDelete({{ $category->id }})"><i class="fas fa-trash"></i> Delete</button>
                            @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1 class="text-center">No Category YET</h1>
            @endif
            <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold"></p>Anda yakin menghapusnya???
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary waves-effect btn-md" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-outline-danger waves-effect btn-md"> Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/' + id
            $('#DeleteModal').modal('show')
        }
    </script>
@endsection
