@extends('app')
@section('title', 'registros')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-clipboard-fill"></i>
        Registro de Registro
    </div>

    <div>
        <div class="bg-white m-4 px-4 py-4">
            @include('components.notification')
            <span>Cadastro de Registros</span>
            <hr>
            <div class="row">
                <div>
                    <label class="form-label" for="Autor">Autor do Documento: </label>
                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" placeholder="" disabled>
                </div>
            </div>
            <form method="post" action="{{route('registro.store')}}">
                @csrf
                @method('post')

                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="data">Data: <span style="color: red"> *</span></label>
                        <input class="form-control" name="data" type="date" id="date" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="col-2 btn btn-semas">Salvar</button>
                    <a href="{{route('registro.index')}}" id="button_clear" class="col-2 btn btn-outline-secondary">Cancelar</a>
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
