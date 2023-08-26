<table class="table table-primary table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Sub_title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Action Button</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($heros as $hero)
            <tr>
                <td>{{$hero->id}}</td>
                <td>{{$hero->title}}</td>
                <td>{{$hero->sub_title}}</td>
                <td>{{$hero->description}}</td>
                <td><img src="{{ asset('storage/'.$hero->image) }}" height="90" width="90"></td>
                <td style="width: 130px"><a href="{{$hero->action_link}}">{{$hero->action_btn}}</a></td>
                <td style="width: 90px">
                    <i class="bi bi-trash3 me-2 text-danger"></i>
                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                    <i class="bi bi-eye text-success"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
