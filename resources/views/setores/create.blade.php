@extends('app')
@section('title', 'registros')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-archive-fill"></i>
        Setores
    </div>
    <div>
        <div class="card border-0 card-body m-4 px-6 py-6">
            @include('components.notification')
            <span>Cadastro</span>
            <hr>

            <form method="post" action="{{route('setor.store')}}">
            @csrf
            @method('post')
                <div class="row mb-3">
                    <div class="col-3 mb-3">
                        <label for="sigla" class="form-label">Sigla <span style="color: red"> *</span></label>
                        <input type="text" name="sigla" class="form-control" style="text-transform: uppercase;">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="nome" class="form-label">Nome <span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="nome" style="text-transform: uppercase;">
                    </div>
                </div>

                <div>
                    <button type="submit" class="col-2 btn btn-semas">Salvar</button>
                    <a href="{{route('setor.index')}}" id="button_clear" class="col-2 btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
@endsection
