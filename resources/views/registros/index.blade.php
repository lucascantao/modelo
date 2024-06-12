@extends('app')
@section('title', 'registros')
@section('content')

<div class="bg-white p-1">
    <i class="bi bi-archive-fill"></i>
    Registros
</div>

<div class="card border-0 m-4 px-6 py-6">
    <div class="card-body">
        <span><i class="bi bi-search me-2"></i></span>Pesquisar registro
        <hr>
        <div id="filtro" class="row">
            <div class="col-lg-3 col-md-4">
                <label class="form-label" for="status_registro">Status</label>
                <select class="form-select" name="status_registro" id="status_registro">
                    <option value="">Todos</option>
                    <option selected value="registrado">Registrado</option>
                    <option value="excluido">Excluído</option>
                </select>
            </div>
            
            @if(Auth::user()->perfil_id==3)
            <div class="col-lg-3 col-md-4 col-sm-12">
                <label class="form-label" for="usuario_registro">Usuário</label>
                <select class="form-control" name="usuario_registro" id="usuario_registro">
                    <option selected value="">Todos</option>
                    @foreach ($users as $usuario)
                        <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                    @endforeach
                </select>
            </div>
            @else
            <div class="col-lg-3 col-md-4 col-sm-12">
                <label class="form-label" for="usuario_registro">Usuário</label>
                <select class="form-control" name="usuario_registro" id="usuario_registro">
                    <option selected value="">Todos</option>
                    @foreach ($users as $usuario)
                    @if(Auth::user()->setor_id==$usuario->setor_id)
                        <option value="{{$usuario->name}}">{{$usuario->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @endif

            <div>
                <button id="button_clear" class="col-lg-2 btn btn-outline-semas mt-4"><i class="bi bi-eraser"></i> Limpar</button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 card-body m-4 px-6 py-6">

    @include('components.notification')

    <span>Relação de Registros</span>
    <hr>
    <div>
        <a class="col-lg-2 btn btn-semas mb-2" href="{{route('registro.create')}}" role="button"><i class="bi bi-plus-circle"></i> Cadastrar</a>
        <button class="col-lg-2 btn btn-semas-secondary mb-2" id="botaoImprimir"><i class="bi bi-file-earmark-ruled me-2"></i>Gerar relatório</button>
    </div>
    <div class="table-container">
        <table id="registro_table" class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Usuário</th>
                    <th scope="col" class="text-center">Data_hidden</th>
                    <th scope="col" class="text-center">Data</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center col-1" >Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $registro)
                <tr>
                    <td class="text-center">{{$registro->id}}</td>
                    <td class="text-center">{{$registro->usuario->name}}</td>
                    <td class="text-center">{{$registro->data}}</td>
                    <td class="text-center">{{date_format(date_create_from_format('Y-m-d', $registro->data), 'd/m/Y')}}</td>
                    
                    @if ($registro->deleted_at == null)
                        <td class="text-center text-success">Registrado</td>
                    @else
                        <td class="text-center text-danger">Excluído</td>    
                    @endif

                    
                    <td class="text-center" style="white-space: nowrap !important">
                        <a class="btn btn-opaque-semas me-1" href="{{route('registro.detail', ['id' => $registro->id])}}"><span><i class="bi bi-eye-fill"></i></span></a>

                        @if (Auth::user() == $registro->usuario || Auth::user()->perfil_id >= 3 || (Auth::user()->perfil_id >= 2 && $registro->setor_id == Auth::user()->setor_id))
                            <a class="btn btn-opaque-semas me-1" href="{{route('registro.edit', ['id' => $registro->id])}}"><span><i class="bi bi-pencil-fill"></i></span></a>
                            @if ($registro->deleted_at == null)
                                
                                <label class="btn btn-opaque-semas-danger me-1" for="delete-{{$registro->id}}-registro"><span><i class="bi bi-trash-fill"></i></span></label>
                                @include('components.modal-delete', [
                                    'name' => 'delete-' . $registro->id . '-registro',
                                    'id' => $registro->id,
                                    'message' => 'Deseja mesmo excluir o registro n°' . $registro->id . ' ?',
                                    'route' => 'registro.disable'
                                ])
                                
                            @else
                                <a class="btn btn-opaque-semas me-1" href="{{route('registro.enable', ['id' => $registro->id, ''])}}"><span><i class="bi bi-arrow-counterclockwise"></i></span></a>  
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
    {{-- @include('registros.responsive.list') --}}
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


<!-- DataTables da Registro -->
<script>

    // TABELA PORTARIA
    var registro_table = $('#registro_table').DataTable({

        order: [
            [0, 'desc']
        ],
        // Tradução
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
        },
        columnDefs: [
            // {target: 0, visible: true},
            {target: 2, visible: false, searchable: true},
            // {target: 6, visible: false, searchable: true},
            // {target: 7, orderable: false},
            {target: 5, orderable: false}
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
                            columns: [0,1,3]
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
                                    '<center><h4>RELAÇÃO DE REGISTROS</h4></center>'
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
      $('#usuario_registro').selectize({
          sortField: 'text'
      });
    });

    $('#usuario_registro').on('change', function() {
        registro_table.column(1).search(this.value).draw();
    });
  
    $('#status_registro').on('change', function() {
        registro_table.column(4).search(this.value).draw();
    });

    //reseta valore dos input e o filtro das datas
    $('#button_clear').on('click', function() {


        $('#filtro select').each( function () {
            $(this).val($(this).find('option[selected]').val());
        });

        $('#filtro input').each(function() {
            $(this).val('');
        });

        registro_table.search('').columns().search('').draw();
        registro_table.column(4).search('Registrado').draw();
    });

    $('#botaoImprimir').on('click', function() {
        //Acionar o botão deGerar relatório do datatables 
        registro_table.button('.buttons-print').trigger();
    });

    registro_table.column(4).search('Registrado').draw();
</script>
@endsection

