<div class="list-container d-none">
    @foreach ($portarias as $portaria)
        <div class="border py-2 px-3 d-flex justify-content-between align-items-center">
            <div><span class="fw-bold">n°</span> {{$portaria->numero}}/{{substr($portaria->data, 0, 4)}}</div>
            <div class="list-container-links">
                <a class="btn btn-outline-dark me-2" href="{{route('portaria.detail', ['id' => $portaria->id])}}"><span><i class="bi bi-eye-fill"></i></span></a>

                    @if (Auth::user() == $portaria->usuario || Auth::user()->perfil_id >= 3 || (Auth::user()->perfil_id >= 2 && $portaria->setor_id == Auth::user()->setor_id))
                        <a class="btn btn-outline-dark me-2" href="{{route('portaria.edit', ['id' => $portaria->id])}}"><span><i class="bi bi-pencil-fill"></i></span></a>
                        @if ($portaria->deleted_at == null)
                            <a class="btn btn-outline-danger me-2" href="{{route('portaria.disable', ['id' => $portaria->id])}}"><span><i class="bi bi-trash-fill"></i></span></a>
                        @else
                            <a class="btn btn-outline-primary me-2" href="{{route('portaria.enable', ['id' => $portaria->id])}}"><span><i class="bi bi-arrow-counterclockwise"></i></span></a>  
                        @endif
                    @else
                        <a class="btn me-2"><span><i class="bi bi-dash"></i></span></a>  
                        <a class="btn me-2"><span><i class="bi bi-dash"></i></span></a>  
                    @endif
            </div>
        </div>
    @endforeach
</div>