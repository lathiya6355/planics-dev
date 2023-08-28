        <div>
            <h1> ID : {{ $result->id }}</h1>
        </div>
        <div>
            <h1>Title : {{ $result->title }}    </h1>
        </div>
        <div>
            <h1>Sub_title : {{ $result->sub_title }}    </h1>
        </div>
        <div>
            <h1>Description : {{ $result->description }}    </h1>
        </div>
        <div>
            <h1>Image</h1>
            <img src="{{ asset('storage/' . $result->image) }}" height="900">
        </div>
