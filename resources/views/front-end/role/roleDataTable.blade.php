<table class="table table-primary table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Permission</th>
            <th scope="col">Create</th>
            <th scope="col">Update</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            {{-- @foreach ($role->permissions as $permission)
            {{dd($permission['name'])}}

            @endforeach --}}
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td style="width: 220px">
                    @foreach ($role->permissions as $permission)
                        {{ $permission['name'] }},
                    @endforeach
                </td>
                <td>{{ $role->created_at }}</td>
                <td>{{ $role->updated_at }}</td>
                <td style="width: 90px">
                    <i class="bi bi-trash3 me-2 text-danger" onclick="delete_data({{ $role->id }})"></i>
                    <a href="{{ url('/role-update/'.$role->id) }}">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
