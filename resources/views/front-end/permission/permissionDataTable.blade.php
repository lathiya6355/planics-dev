<table class="table table-primary table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Create</th>
            <th scope="col">Update</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td style="width: 220px">
                    @foreach ($permission->roles as $roles)
                        {{ $roles['name'] }},
                    @endforeach
                </td>
                <td>{{ $permission->created_at }}</td>
                <td>{{ $permission->updated_at }}</td>
                <td style="width: 90px">
                    <i class="bi bi-trash3 me-2 text-danger" onclick="delete_data({{ $permission->id }})"></i>
                    <a href="{{ url('/permission-update/'.$permission->id) }}">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                    </a>
                    <i class="bi bi-eye text-success"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
