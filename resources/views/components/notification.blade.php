<div>
    @if(session()->has('success'))
        <div class="alert alert-success" id="successMessage">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('failed'))
        <div class="alert alert-danger" id="failedMessage">
            {{ session('failed') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger" id="failedMessage">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
</div>