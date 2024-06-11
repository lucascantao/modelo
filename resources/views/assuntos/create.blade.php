@extends('app')
@section('title', 'portarias')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-chat-square-quote-fill"></i>
        Assuntos
    </div>
    <div>
        <div class="card border-0 card-body m-4 px-6 py-6">
            @include('components.notification')
            <span>Cadastro</span>
            <hr>
            
            <form method="post" action="{{route('assunto.store')}}">
            @csrf
            @method('post')
                <div class="row mb-3">
                    <div class="col-5 mb-3">
                        <label for="nome" class="form-label">Nome <span style="color: red"> *</span></label>
                        <input type="text" class="form-control" name="nome" style="text-transform: uppercase;">
                    </div>
                    <div class="col-7 mb-3">
                        <label for="descricao" class="form-label">Descrição</span></label>
                        <input type="text" name="descricao" class="form-control" >
                    </div>
                </div>

                <div>
                    <button type="submit" class="col-2 btn btn-semas">Salvar</button>
                    <a href="{{route('assunto.index')}}" id="button_clear" class="col-2 btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
@endsection
