<span><a href="/"><img src="{{asset('images/SiCop-v1.png')}}" width="120px" style="object-fit: fill;" alt=""></a></span>
<form method="POST" action="{{ route('register') }}" class="d-flex flex-column align-items-center justify-content-center">
    @csrf
    <!-- Name -->
    <div class="mt-4 w-100 px-2">
        <label for="name">Nome</label>
        <input id="name" class="form-control-lg" type="text" name="name" value="{{session()->get('user')['name']}}" required autofocus autocomplete="name" />
    </div>

    <!-- Email Address -->
    <div class="mt-4 w-100 px-2">
        <label for="email">Email</label>
        <input id="email" class="form-control-lg" type="email" name="email" value="{{session()->get('user')['email']}}" required autocomplete="email" />
        {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
    </div>

    <!-- Username -->
    <div class="mt-4 w-100 px-2">
        <label for="username">Usuário</label>
        <input id="username" class="form-control-lg" type="text" name="username" value="{{session()->get('user')['username']}}" hidden required autocomplete="username" />
        <div id="usuario" class="mt-1 form-control-lg">{{session()->get('user')['username']}}</div>
    </div>

    <!-- Setor -->
    <div class="mt-4 w-100 px-2">
        <label class="form-label" for="Setor">Setor</label>
        <select class="" name="setor" id="setor" required>
            <option selected hidden value="">Selecionar Setor</option>
            @foreach ($setores as $setor)
                <option name="{{$setor->sigla}}" value="{{$setor->id}}" id="">{{$setor->sigla}} - {{$setor->nome}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4"></div>

    <div class="d-flex justify-content-center">
        <button id="register_button" type="submit" class="btn btn-semas">
            Registrar
        </button>
    </div>

    
</form>
<script>
    $(document).ready(function () {
      $('#setor').selectize({
          sortField: 'text'
      });
    });
</script>