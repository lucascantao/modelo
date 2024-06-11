@extends('app')
@section('title', 'portarias')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-clipboard-fill"></i>
        Edição de Portaria
    </div>

    <div>
        <div class="card border-0 card-body m-4 px-6 py-6">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <span>Edição de Portarias</span>
            <hr>
            <div>
                <label class="form-label"><h1><b>Portaria:</b></h1></label>
                <label class="form-label"><h1>{{ $portaria->numero.'/'. substr($portaria->data, 0, 4) }}</h1></label>
            </div>  
            <form method="post" action="{{route('portaria.update', ['id' => $portaria->id])}}">
                @csrf
                @method('put')

                <div class="row">
                    <div>
                        <label class="form-label" for="Autor">Autor do Documento: </label>
                        <input hidden type="text" value="{{ $portaria->usuario_id }}" name="usuario_id">
                        <input class="form-control bg-secondary-subtle" type="text" value="{{ $portaria->usuario->name }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <label class="form-label" for="Setor">Setor: </label>
                        <input hidden type="number" value="{{ $portaria->setor_id }}" name="setor_id">
                        <input class="form-control bg-secondary-subtle" type="text" value="{{ $portaria->setor->sigla }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="processo">Processo: </label>
                        <input class="form-control" name="processo" type="text" placeholder="" value="{{ $portaria->processo }}">
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data">Data: <span style="color: red"> *</span></label>
                        <input class="form-control" name="data" type="date" id="date" value="{{ $portaria->data }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="assunto">Assunto: <span style="color: red"> *</span></label>
                        <select class="" name="assunto_id" id="assunto_id">
                            <option selected hidden value="{{ $portaria->assunto_id }}">{{ $portaria->assunto->nome }}</option>
                            @foreach ($assuntos as $assunto)
                                <option value={{ $assunto->id }}>{{ $assunto->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data_inicio">Início: </label>
                        <input class="form-control" name="data_inicio" id="data_inicio" type="date" value="{{ $portaria->data_inicio }}">
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data_final">Término: </label>
                        <input class="form-control" name="data_final" id="data_final" type="date" value="{{ $portaria->data_final }}" @if($portaria->data_final == null){ disabled } @endif>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="observacoes">Observações: </label>
                        <textarea rows="5" class="form-control" name="observacoes" placeholder="">{{ $portaria->observacoes }}</textarea>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label" for="destino">Destino: </label>
                        <input class="form-control" name="destino" type="text" placeholder="" value="{{ $portaria->destino }}">
                    </div>
                </div>

                <div class="mt-4">
                    @if ($portaria->deleted_at == null)
                        <button id="salvar_portaria" type="submit" disabled class="col-2 btn btn-semas">Salvar</button>
                        <a href="{{route('portaria.index')}}" id="button_clear" class="col-2 btn btn-outline-secondary">Cancelar</a>
                    @else
                        <a class="col-2 btn btn-semas" href="{{route('portaria.enable', ['id' => $portaria->id])}}">Restaurar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        var data = $('#date');
        var current_value = data.val();
        var ano = moment(data.val(), 'YYYY-MM-DD').format('YYYY');

        $('#date').on('change', function () {
            if(moment($(this).val(), 'YYYY-MM-DD').format('YYYY') != ano) {
                alert('A data da portaria não pode exceder o ano atual da portaria');
                data.val(current_value);
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#assunto_id').selectize({
                sortField: 'text'
            });
        });

        $(document).ready(function() {
            $('#Ano').on('keypress', function(event) {
                if (!/[0-9\b]/.test(event.key)) {
                    event.preventDefault();
                }
            });
        });
    </script>

    <script>

        var SELECT_CHANGE = false;
        var INPUT_CHANGE = false;

        function checkValueChange() {
            if(SELECT_CHANGE || INPUT_CHANGE) {
                $('#salvar_portaria').attr('disabled', false);
            } else {
                $('#salvar_portaria').attr('disabled', true);
            }
        }

        // Assunto
        var assunto = $('#assunto_id');
        var current_assunto_value = assunto.val();
        assunto.on('change', function () {
            if(assunto.val() != current_assunto_value){
                SELECT_CHANGE = true;
            } else {
                SELECT_CHANGE = false;
            }
            checkValueChange();
        });

        //Inputs
        $('.form-control').each(function () {

            var input = $(this);
            var current_input_value = input.val();

            $(input)
            .on('change', function () {
                if($(this).val() != current_input_value) {
                    INPUT_CHANGE = true;
                } else {
                    INPUT_CHANGE = false;
                }
                checkValueChange();
            })
            .on('keyup', function () {
                if($(this).val() != current_input_value) {
                    INPUT_CHANGE = true;
                } else {
                    INPUT_CHANGE = false;
                }
                checkValueChange();
            });
        });
    </script>
    {{-- Script para prevenir inconsistência entre datas --}}
    <script src="{{asset('js/date.js')}}"></script>
@endsection
