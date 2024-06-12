@extends('app')
@section('title', 'registros')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-clipboard-fill"></i>
        Edição de Registro
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
            <span>Edição de Registros</span>
            <hr>
            <div>
                <label class="form-label"><h1><b>Registro:</b></h1></label>
                <label class="form-label"><h1>{{ $registro->numero.'/'. substr($registro->data, 0, 4) }}</h1></label>
            </div>  
            <form method="post" action="{{route('registro.update', ['id' => $registro->id])}}">
                @csrf
                @method('put')

                <div class="row">
                    <div>
                        <label class="form-label" for="Autor">Autor do Documento: </label>
                        <input hidden type="text" value="{{ $registro->usuario_id }}" name="usuario_id">
                        <input class="form-control bg-secondary-subtle" type="text" value="{{ $registro->usuario->name }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data">Data: <span style="color: red"> *</span></label>
                        <input class="form-control" name="data" type="date" id="date" value="{{ $registro->data }}">
                    </div>
                </div>

                <div class="mt-4">
                    @if ($registro->deleted_at == null)
                        <button id="salvar_registro" type="submit" disabled class="col-2 btn btn-semas">Salvar</button>
                        <a href="{{route('registro.index')}}" id="button_clear" class="col-2 btn btn-outline-secondary">Cancelar</a>
                    @else
                        <a class="col-2 btn btn-semas" href="{{route('registro.enable', ['id' => $registro->id])}}">Restaurar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>

        var SELECT_CHANGE = false;
        var INPUT_CHANGE = false;

        function checkValueChange() {
            if(SELECT_CHANGE || INPUT_CHANGE) {
                $('#salvar_registro').attr('disabled', false);
            } else {
                $('#salvar_registro').attr('disabled', true);
            }
        }

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
@endsection
