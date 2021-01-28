@if($errors->any())
    <div class="alert alert-default-warning">
        @foreach($errors->all() as $error)
            <div>{!! $error !!}</div>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div class="alert alert-default-success text-center">
        {{ session('success')  }}
    </div>
@endif
