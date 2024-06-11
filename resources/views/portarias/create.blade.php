@extends('app')
@section('title', 'portarias')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-clipboard-fill"></i>
        Registro de Portaria
    </div>

    <div>
        <div class="bg-white m-4 px-4 py-4">
            @include('components.notification')
            <span>Cadastro de Portarias</span>
            <hr>
            <div class="row">
                <div>
                    <label class="form-label" for="Autor">Autor do Documento: </label>
                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" placeholder="" disabled>
                </div>
            </div>
            <div class="row">
                <div>
                    <label class="form-label" for="Setor">Setor: </label>
                    <input class="form-control" type="text" value="{{ $nomeSetor }}" placeholder="" disabled>
                </div>
            </div>
            <form method="post" action="{{route('portaria.store')}}">
                @csrf
                @method('post')

                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="processo">Processo: </label>
                        <input class="form-control" name="processo" type="text" placeholder="">
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data">Data: <span style="color: red"> *</span></label>
                        <input class="form-control" name="data" type="date" id="date" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="assunto">Assunto: <span style="color: red"> *</span></label>
                        <select class="" name="assunto_id" id="assunto_id">
                            @foreach ($assuntos as $assunto)
                                <option selected hidden>Selecionar assunto</option>
                                <option value={{$assunto->id}}>{{$assunto->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data_inicio">Início: </label>
                        <input class="form-control" name="data_inicio" id="data_inicio" type="date">
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data_final">Término: </label>
                        <input class="form-control" name="data_final" id="data_final" type="date" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="observacoes">Observações: </label>
                        <textarea rows="5" class="form-control" name="observacoes" placeholder=""></textarea>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="destino">Destino: </label>
                        <input class="form-control" name="destino" type="text" placeholder="">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="col-2 btn btn-semas">Salvar</button>
                    <a href="{{route('portaria.index')}}" id="button_clear" class="col-2 btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script>

        $(document).ready(function () {
            $('#assunto_id').selectize({
                sortField: 'text'
            });
        });
        $('#button_clear').on('click', function() {
            $('#filtro select').each( function () {
                $(this).val($(this).find('option[selected]').val());
            })
            $('#filtro input').each(function() {
                $(this).val('');
            })
        })

        $(document).ready(function() {
            $('#date').attr('min', new Date().toISOString().slice(0, 10));
        });

        $(document).ready(function() {
            $('#Ano').on('keypress', function(event) {
                if (!/[0-9\b]/.test(event.key)) {
                    event.preventDefault();
                }
            });
        });
    </script>

    {{-- Script para prevenir inconsistência entre datas --}}
    <script src="{{asset('js/date.js')}}"></script>
@endsection
