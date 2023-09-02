        {{-- <div>
            <h1> ID : {{ $result->id }}</h1>
        </div> --}}
        <div class="container d-flex align-items-center justify-content-center">
            <div style="width: 50%" class="me-4">
                <div class="">
                    <h3>Title : </h3>
                    <h6> {{ $result->title }} </h6>
                </div>
                <div class="mt-4">
                    <h3>Sub Title : </h3>
                    <h6>{{ $result->sub_title }}</h6>
                </div>
                <div class="mt-4">
                    <h3>Description : </h3>
                    <h6>{{ $result->description }}</h6>
                </div>
            </div>
            <div style="width: 50%">
                <div class="mb-3">
                    <h3></h3>
                    <img src="{{ asset('storage/' . $result->image) }}" height="500">
                </div>
            </div>
        </div>
