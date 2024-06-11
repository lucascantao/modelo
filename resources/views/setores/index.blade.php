@extends('app')
@section('title', 'setores')
@section('content')

<div class="bg-white p-1">
    <i class="bi bi-archive-fill"></i>
    Setores
</div>

<div class="card border-0 m-4 px-6 py-6">
    <div class="card-body">
        <span><i class="bi bi-search me-2"></i></span>Pesquisar setor
        <hr>
        <div class="row row-cos-6">
            <div class="col-2">
                <label for="setor_sigla" class="form-label">Sigla</label>
                <input id="setor_sigla_input" type="text" class="form-control text-uppercase">
            </div>
            <div class="col-10">
                <label for="setor_nome" class="form-label">Nome</label>
                <input id="setor_nome_input" type="text" class="form-control text-uppercase">
            </div>
        </div>
    </div>

</div>

<div class="card border-0 card-body m-4 px-6 py-6">
    
    @include('components.notification')
    
    <span>Relação de Setores</span>
    <hr>
    <div>
        <a class="col-lg-2 btn btn-semas mb-2" href="{{route('setor.create')}}" role="button"><i class="bi bi-plus-circle"></i> Cadastrar</a>
        <button class="col-lg-2 btn btn-semas-secondary mb-2" id="botaoImprimir"><i class="bi bi-file-earmark-ruled me-2"></i>Gerar relatório</button>
    </div>
    <table id="setor_table" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sigla</th>
                <th scope="col">Nome</th>
                <th scope="col" class="text-center col-2">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($setores as $setor)
            <tr>
                <td>{{$setor->id}}</td>
                <td>{{$setor->sigla}}</td>
                <td>{{$setor->nome}}</td>
                <td class="text-center" style="white-space: nowrap !important">
                    <a class="btn btn-opaque-semas me-2" href="{{route('setor.edit', ['setor' => $setor])}}"><span><i class="bi bi-pencil-fill"></i></span></a>
                    <label class="btn btn-opaque-semas-danger me-1" for="delete-{{$setor->id}}-setor"><span><i class="bi bi-trash-fill"></i></span></label>
                    @include('components.modal-delete', [
                        'name' => 'delete-' . $setor->id . '-setor',
                        'id' => $setor->id,
                        'message' => 'Deseja mesmo excluir o setor ' . $setor->nome . ' ?',
                        'route' => 'setor.destroy'
                    ])
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- DataTables -->
<!-- <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script>
        var setorTable = new DataTable('#setor_table', {
            order: [
                [1, 'asc']
            ],
            columnDefs: [
                {target: 0, visible: false},
                {target: 1, orderable: true},
                {target: 2, orderable: true},
                {
                    target: 3, 
                    orderable: false,
                    className: 'action'
                },
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
            },
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
                        //Esconder o botão padrão de print do datatables
                        init: function(api, node, config) {
                            $(node).hide();
                        },
                        exportOptions: {
                            columns: [1, 2] // Índices das colunas que serão impressas (começando em 0)
                        },
                        title: '',
                        autoPrint: false, // Evita a impressão automática
                        footer: true, // Habilita o footer
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '12pt')
                                .prepend(
                                    '<center><img src="{{asset('images/brasao-pa.png')}}" width="100px"  /></center>',
                                    '<center><h6>GOVERNO DO ESTADO DO PARÁ</h6></center>',
                                    '<center><h6>SECRETARIA DE MEIO AMBIENTE E SUSTENTABILIDADE</h7></center>',
                                    '<BR><BR>',
                                    '<center><h4>RELAÇÃO DE SETORES</h4></center>'
                                );
    
                            $(win.document.body)
                                .find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                            
                            // Adiciona o conteúdo do footer ao documento de impressão
                            $(win.document.body).append('<div style="text-align:center;margin-top:100px;">DTI/GESIS © 2024 Secretaria de Meio Ambiente e Sustentabilidade.</div>');
                            
                        }
                    }]
                }
            }
        });

    // Pesquisa por Sigla -> coluna 1
    $('#setor_sigla_input').on('keyup', function() {
        setorTable.column(1).search(this.value).draw();
    })

    // Pesquisa por nome -> coluna 2
    $('#setor_nome_input').on('keyup', function() {
        setorTable.column(2).search(this.value).draw();
    })

    $('#botaoImprimir').on('click', function() {
        //Acionar o botão deGerar relatório do datatables 
        setorTable.button('.buttons-print').trigger();
    });
</script>

@endsection