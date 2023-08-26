<table class="table table-primary table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Create</th>
            <th scope="col">Update</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->created_at}}</td>
                <td>{{$role->updated_at}}</td>
                <td style="width: 90px">
                    <i class="bi bi-trash3 me-2 text-danger"></i>
                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                    <i class="bi bi-eye text-success"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
