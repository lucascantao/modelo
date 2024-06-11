@extends('app')
@section('title', 'usuarios')
@section('content')

<div class="bg-white p-1">
    <i class="bi bi-people-fill"></i>
    Gerenciar Usuários
</div>

<div class="card border-0 m-4 px-6 py-6">
    <div class="card-body">
        <span><i class="bi bi-search me-2"></i></span>Pesquisar Usuário
        <hr>
        <div class="row row-cos-6">
            <div class="col-6">
                <label for="usuario_nome" class="form-label">Nome</label>
                <input id="usuario_usuario_nome" type="text" class="form-control">
            </div>
            <div class="col-6">
                <label for="usuario_email" class="form-label">E-mail</label>
                <input id="usuario_usuario_email" type="text" class="form-control">
            </div>
        </div>
        <div class="row row-cos-6">
            <div class="col-4">
                <label for="usuario_setor" class="form-label">Setor</label>
                <select class="form-select" name="usuario_usuario_setor" id="usuario_usuario_setor">
                    <option value="">Selecionar setor</option>
                    @foreach ($setores as $setor)
                        <option value="{{$setor->sigla}}">{{$setor->sigla . ' - ' . $setor->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="usuario_perfil" class="form-label">Perfil</label>
                <select class="form-select" name="usuario_usuario_perfil" id="usuario_usuario_perfil">
                    <option value="">Selecionar perfil</option>
                    @foreach ($perfis as $perfil)
                        <option value="{{$perfil->nome}}">{{$perfil->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="usuario_status" class="form-label">Status</label>
                <select class="form-select" name="usuario_usuario_status" id="usuario_usuario_status">
                    <option value="">Selecionar status</option>
                    <option value="habilitado">Habilitado</option>
                    <option value="desabilitado">Desabilitado</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 card-body m-4 px-6 py-6">
    
    @include('components.notification')

    <span>Relação de Usuários</span>
    <hr>
    <div>
        <button class="col-lg-2 btn btn-semas-secondary mb-2" id="botaoImprimir"><i class="bi bi-file-earmark-ruled me-2"></i>Gerar relatório</button>
    </div>
    <table id="usuario_table" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Setor</th>
                <th scope="col">Perfil</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center col-2">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->setores->sigla}}</td>
                @if ($user->perfil_id != null)
                    <td class="text-success fw-bold">{{$user->perfil->nome}}</td>
                @else
                    <td class="text-warning">sem perfil</td>
                @endif

                @if ($user->deleted_at != null)
                    <td class="text-danger">Desabilitado</td>
                @else
                    <td class="text-success">Habilitado</td>
                @endif
                <td class="text-center">
                    @if ($user->perfil_id <= Auth::user()->perfil_id)<a class="btn btn-opaque-semas me-2" href="{{route('user.edit', ['id' => $user->id])}}"><span><i class="bi bi-pencil-fill"></i></span></a>@endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script>
    
    var usuario_table = $('#usuario_table').DataTable({

        // Tradução
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.0.3/i18n/pt-BR.json',
        },
        order: [
            [1, 'asc']
        ],
        columnDefs: [
            {target: 0, visible: false},
            {target: 6, orderable: false},
        ],
        fixedHeader: {
            header:true,
            footer: true,
        },
        // Remover controles padrão
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
                            columns: [1, 2, 3] // Índices das colunas que serão impressas (começando em 0)
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
                                    '<center><h4>RELAÇÃO DE USUARIOS</h4></center>'
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
            },
        });

    $('#usuario_usuario_nome').on('keyup', function() {
        usuario_table.column(1).search(this.value).draw();
    })
    $('#usuario_usuario_email').on('keyup', function() {
        usuario_table.column(2).search(this.value).draw();
    })
    $('#usuario_usuario_setor').on('change', function() {
        usuario_table.column(3).search(this.value).draw();
        // alert(this.value);
    })
    $('#usuario_usuario_perfil').on('change', function() {
        usuario_table.column(4).search(this.value).draw();
    })
    $('#usuario_usuario_status').on('change', function() {
        usuario_table.column(5).search(this.value).draw();
    })

    $('#botaoImprimir').on('click', function() {
        //Acionar o botão deGerar relatório do datatables 
        usuario_table.button('.buttons-print').trigger();
    });
    
</script>
@endsection
