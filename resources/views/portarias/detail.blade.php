@extends('app')
@section('title', 'portarias')
@section('content')
    <div class="bg-white p-1">
        <i class="bi bi-clipboard-fill"></i>
        Detalhes da Portaria
    </div>
    <div>
        <div class="bg-white m-4 px-4 py-4">
            <div>
                <label class="form-label"><h1><b>Portaria:</b></h1></label>
                <label class="form-label"><h1>{{ $numero .'/'. substr($data, 6, 4) }}</h1></label>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-4">
                    <label class="form-label"><b>Autor do Documento:</b></label><br>
                    <label class="form-label">{{ $nome }}</label>
                </div>
                <div class="col-lg-6 col-md-4">
                    <label class="form-label"><b>Setor:</b></label><br>
                    <label class="form-label">{{ $nomeSetor }}</label>
                </div>
            </div>
            <div id="filtro" class="row">
                <div class="col-lg-6 col-md-4">
                    <label class="form-label"><b>Processo:</b></label><br>
                    <label class="form-label">{{ $processo }}</label>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label"><b>Data:</b></label><br>
                    <label class="form-label">{{ $data }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-4">
                    <label class="form-label"><b>Assunto:</b></label><br>
                    <label class="form-label">{{ $assunto }}</label>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label"><b>Início:</b></label><br>
                    <label class="form-label">{{ $data_inicio }}</label>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label"><b>Término:</b></label><br>
                    <label class="form-label">{{ $data_final }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-4">
                    <label class="form-label"><b>Destino:</b></label><br>
                    <label class="form-label">{{ $destino }}</label>
                </div>
                <div class="col-lg-6 col-md-4">
                    <label class="form-label"><b>Observações:</b></label><br>
                    <label class="form-label" style="text-align: justify" >{{ $observacoes }}</label>
                </div>
            </div>

            <hr>

            @if ($updated_by != null)
                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label text-secondary"><b>Atualizado por:</b></label><br>
                        <label class="form-label text-secondary" style="text-align: justify" >{{ $updated_by->name }}</label>
                    </div>
                </div>                    
            @endif
            
            @if ($deleted_at != null)
                <div class="row">
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label text-danger"><b>Deletado em:</b></label><br>
                        <label class="form-label text-danger">{{ $deleted_at }}</label>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <label class="form-label text-danger"><b>Deletado por:</b></label><br>
                        <label class="form-label text-danger" style="text-align: justify" >{{ $deleted_by->name }}</label>
                    </div>
                </div>                    
            @endif

            @if(Auth::user()->id == $user_id)
            <div class="mt-4">
                <a class="col-2 btn btn-secondary" href="{{route('portaria.index')}}">Voltar</a>

                @if ($deleted_at == null)
                    <label class="col-2 btn btn-outline-danger" for='delete-{{$id}}-portaria'>Deletar</label>
                @else
                    <a class="col-2 btn btn-semas" href="{{route('portaria.enable', ['id' => $id])}}">Restaurar</a>
                @endif
            </div>
            @endif

            @include('components.modal-delete', [
                'name' => 'delete-' . $id . '-portaria',
                'id' => $id,
                'message' => 'Deseja mesmo excluir a portaria n°' . $numero .'/'. substr($data, 6, 4) . ' ?',
                'route' => 'portaria.disable'
            ])
            
        </div>
@endsection
