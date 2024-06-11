@extends('app')
@section('title', 'portarias')
@section('content')

<div class="bg-white p-1">
    <i class="bi bi-archive-fill"></i>
    Portarias
</div>

<div class="card border-0 m-4 px-6 py-6">
    <div class="card-body">
        <span><i class="bi bi-search me-2"></i></span>Pesquisar portaria
        <hr>
        <div id="filtro" class="row">
            <div class="col-lg-1 col-md-2">
                <label for="ano_portaria" class="form-label">Ano</label>
                <input id="ano_portaria" type="text" class="form-control">
            </div>
            <div class="col-lg-2 col-md-2">
                <label for="numero_portaria" class="form-label">Número portaria</label>
                <input id="numero_portaria" type="text" class="form-control">
            </div>
            <div class="col-lg-3 col-md-4">
                <label class="form-label" for="assunto_portaria">Assunto</label>
                <select class="form-control" name="assunto_portaria" id="assunto_portaria">
                    <option selected value="">Todos</option>
                    @foreach ($assuntos as $assunto)
                        <option value={{$assunto->id}}>{{$assunto->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-4">
                <label class="form-label" for="status_portaria">Status</label>
                <select class="form-select" name="status_portaria" id="status_portaria">
                    <option value="">Todos</option>
                    <option selected value="registrado">Registrado</option>
                    <option value="excluido">Excluído</option>
                </select>
            </div>
            
            @if(Auth::user()->perfil_id==3)
            <div class="col-lg-3 col-md-4 col-sm-12">
                <label class="form-label" for="usuario_portaria">Usuário</label>
                <select class="form-control" name="usuario_portaria" id="usuario_portaria">
                    <option selected value="">Todos</option>
                    @foreach ($users as $usuario)
                        <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                    @endforeach
                </select>
            </div>
            @else
            <div class="col-lg-3 col-md-4 col-sm-12">
                <label class="form-label" for="usuario_portaria">Usuário</label>
                <select class="form-control" name="usuario_portaria" id="usuario_portaria">
                    <option selected value="">Todos</option>
                    @foreach ($users as $usuario)
                    @if(Auth::user()->setor_id==$usuario->setor_id)
                        <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @endif

            <div class="col-lg-6 col-md-4">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="date_start">Data Início</label>
                        <input class="form-control" type="text" placeholder="--/--/--" id="date_start" name="date_start">
                    </div>
                    <div class="col">
                        <label class="form-label" for="date_end">Data fim</label>
                        <input class="form-control" type="text" placeholder="--/--/--" id="date_end" name="date_end">
                    </div>
                </div>
            </div>
            
            @if(Auth::user()->perfil_id==3)
            <div class="col-lg-3 col-md-4 col-sm-12">
                <label class="form-label" for="setor_portaria">Setor</label>
                <select class="form-control" name="setor_portaria" id="setor_portaria">
                    <option selected value="">Todos</option>
                    @foreach ($setores as $setor)
                        <option value="{{$setor->sigla}}">{{$setor->sigla}} - {{$setor->nome}}</option>
                    @endforeach
                </select>
            </div>
            @else
            {{-- <div class="col-lg-3 col-md-4 col-sm-12">
                <label class="form-label" for="setor_portaria">Setor</label>
                <select class="form-control" name="setor_portaria" id="setor_portaria" disabled>
                    @foreach ($setores as $setor)
                    @if ($setor->id == Auth::user()->setor_id)
                        <option selected value="{{$setor->sigla}}">{{$setor->sigla}} - {{$setor->nome}}</option>
                    @endif
                    @endforeach
                </select>
            </div> --}}

            @endif


            <div>
                <button id="button_clear" class="col-lg-2 btn btn-outline-semas mt-4"><i class="bi bi-eraser"></i> Limpar</button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 card-body m-4 px-6 py-6">

    @include('components.notification')

    <span>Relação de Portarias</span>
    <hr>
    <div>
        <a class="col-lg-2 btn btn-semas mb-2" href="{{route('portaria.create')}}" role="button"><i class="bi bi-plus-circle"></i> Cadastrar</a>
        <button class="col-lg-2 btn btn-semas-secondary mb-2" id="botaoImprimir"><i class="bi bi-file-earmark-ruled me-2"></i>Gerar relatório</button>
    </div>
    <div class="table-container">
        <table id="portaria_table" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center col-1">Ano</th>
                    <th scope="col" class="text-center col-1">Nº Portaria </th>
                    <th scope="col" class="text-center">Assunto Id</th>
                    <th scope="col" class="text-center">Assunto</th>
                    <th scope="col" class="text-center">Usuário</th>
                    <th scope="col" class="text-center">Setor</th>
                    <th scope="col" class="text-center">Data_hidden</th>
                    <th scope="col" class="text-center">Data</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center col-1" >Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($portarias as $portaria)
                <tr>
                    <td class="text-center">{{substr($portaria->data, 0, 4)}}</td>
                    <td class="text-center">{{$portaria->numero}}</td>
                    <td class="text-center">{{$portaria->assunto_id}}</td>
                    <td class="text-center">{{$portaria->assunto->nome}}</td>
                    <td class="text-center">{{$portaria->usuario->name}}</td>
                    <td class="text-center">{{$portaria->setor->sigla}}</td>
                    <td class="text-center">{{$portaria->data}}</td>
                    <td class="text-center">{{date_format(date_create_from_format('Y-m-d', $portaria->data), 'd/m/Y')}}</td>
                    
                    @if ($portaria->deleted_at == null)
                        <td class="text-center text-success">Registrado</td>
                    @else
                        <td class="text-center text-danger">Excluído</td>    
                    @endif

                    
                    <td class="text-center" style="white-space: nowrap !important">
                        <a class="btn btn-opaque-semas me-1" href="{{route('portaria.detail', ['id' => $portaria->id])}}"><span><i class="bi bi-eye-fill"></i></span></a>

                        @if (Auth::user() == $portaria->usuario || Auth::user()->perfil_id >= 3 || (Auth::user()->perfil_id >= 2 && $portaria->setor_id == Auth::user()->setor_id))
                            <a class="btn btn-opaque-semas me-1" href="{{route('portaria.edit', ['id' => $portaria->id])}}"><span><i class="bi bi-pencil-fill"></i></span></a>
                            @if ($portaria->deleted_at == null)
                                
                                <label class="btn btn-opaque-semas-danger me-1" for="delete-{{$portaria->id}}-portaria"><span><i class="bi bi-trash-fill"></i></span></label>
                                @include('components.modal-delete', [
                                    'name' => 'delete-' . $portaria->id . '-portaria',
                                    'id' => $portaria->id,
                                    'message' => 'Deseja mesmo excluir a portaria n°' . $portaria->numero .'/'. substr($portaria->data, 0, 4) . ' ?',
                                    'route' => 'portaria.disable'
                                ])
                                
                            @else
                                <a class="btn btn-opaque-semas me-1" href="{{route('portaria.enable', ['id' => $portaria->id, ''])}}"><span><i class="bi bi-arrow-counterclockwise"></i></span></a>  
                            @endif
                        @else
                            <a class="btn me-1"><span><i class="bi bi-dash"></i></span></a>  
                            <a class="btn me-1"><span><i class="bi bi-dash"></i></span></a>  
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @include('portarias.responsive.list')
</div>

<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>

<!-- Print -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>


<!-- DataTables da Portaria -->
<script>

    //Campos data início e final
    let minDate, masDate;

    function initializeDateFields() {
            minDate = new DateTime('#date_start', {
            format: 'DD/MM/YYYY'
        });

        maxDate = new DateTime('#date_end', {
            format: 'DD/MM/YYYY'
        });
    };

    //Função filtro por data
    DataTable.ext.search.push(function (setting, data, dataIndex) {

        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[6]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    //inicializa campos de data
    initializeDateFields();

    // TABELA PORTARIA
    var portaria_table = $('#portaria_table').DataTable({

        order: [
            [0, 'desc']
        ],
        // Tradução
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
        },
        columnDefs: [
            {target: 0, visible: true},
            {target: 2, visible: false, searchable: true},
            {target: 6, visible: false, searchable: true},
            {target: 7, orderable: false},
            {target: 9, orderable: false}
        ],
        layout: {
            topEnd: {
                pageLength: {
                    menu: [5, 10, 25, 50]
                }
            },

            topStart: {
                buttons: [
                    {
                        extend: 'print',
                        class: 'buttons-print',
                        exportOptions: {
                            columns: [0,1,3,4,5,7]
                        },
                        init: function(api, node, config) {
                            $(node).hide();
                        },
                        title: '',
                        autoPrint: false,
                        footer: true,
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')
                                .prepend(
                                    '<center><img src="{{asset('images/brasao-pa.png')}}" width="100px"  /></center>',
                                    '<center><h6>GOVERNO DO ESTADO DO PARÁ</h6></center>',
                                    '<center><h6>SECRETARIA DE MEIO AMBIENTE E SUSTENTABILIDADE</h7></center>',
                                    '<BR><BR>',
                                    '<center><h4>RELAÇÃO DE PORTARIAS</h4></center>'
                                );

                            $(win.document.body)
                                .find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');

                            // Adiciona o conteúdo do footer ao documento de impressão
                            $(win.document.body).append('<div style="text-align:center;margin-top:100px;">DTI/GESIS © 2024 Secretaria de Meio Ambiente e Sustentabilidade.</div>');
                        },
                    }
                ]
            }
        },
    });

    $(document).ready(function () {
      $('#assunto_portaria').selectize({
          sortField: 'text'
      });
    });

    $(document).ready(function () {
      $('#usuario_portaria').selectize({
          sortField: 'text'
      });
    });

    $(document).ready(function () {
      $('#setor_portaria').selectize({
          sortField: 'text'
      });
    });

    // Pesquisa por número de portaria -> coluna 1
    $('#ano_portaria').on('keyup', function() {
        portaria_table.column(0).search(this.value).draw();
    });

    $('#numero_portaria').on('keyup', function() {
        portaria_table.column(1).search(this.value).draw();
    });

    $('#assunto_portaria').on('change', function() {
        portaria_table.column(2).search(this.value).draw();
    });

    $('#usuario_portaria').on('change', function() {
        portaria_table.column(4).search(this.value).draw();
    });

    $('#setor_portaria').on('change', function() {
        portaria_table.column(5).search(this.value).draw();
    });

    
    $('#status_portaria').on('change', function() {
        portaria_table.column(8).search(this.value).draw();
    });


    document.querySelectorAll('#date_start, #date_end').forEach((el) => {
        el.addEventListener('change', () => portaria_table.draw());
    });

    //reseta valore dos input e o filtro das datas
    $('#button_clear').on('click', function() {

        $('#assunto_portaria').selectize()[0].selectize.clear();
        $('#usuario_portaria').selectize()[0].selectize.clear();

        if($('#setor_portaria').selectize()[0] != undefined){
            $('#setor_portaria').selectize()[0].selectize.clear();
        }


        $('#filtro select').each( function () {
            $(this).val($(this).find('option[selected]').val());
        });

        $('#filtro input').each(function() {
            $(this).val('');
        });

        initializeDateFields();
        portaria_table.search('').columns().search('').draw();
        portaria_table.column(8).search('Registrado').draw();
    });

    $('#botaoImprimir').on('click', function() {
        //Acionar o botão deGerar relatório do datatables 
        portaria_table.button('.buttons-print').trigger();
    });

    portaria_table.column(8).search('Registrado').draw();
</script>
@endsection

