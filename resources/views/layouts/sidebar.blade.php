<div class="d-flex flex-column fixed-top" id="sidebar">
    <img id="sidebar-img" src="{{asset('images/sidebar-bg.png')}}">
    <div class="d-flex justify-content-between align-middle p-3 text-white">
        MENU
    </div>
    <ul class="nav nav-pills flex-column">
        <li>
            {{-- <a href="{{route('portaria.registrar')}}" class="nav-link text-white align-middle">
                <i class="bi bi-search"></i>
                <span>Registrar Portaria</span></a> --}}
        </li>
        <li>
            <a href="{{route('portaria.index')}}" class="nav-link text-white align-middle">
                <i class="bi bi-file-earmark-check-fill"></i>
                <span>Portarias</span></a>
        </li>

        @if (Auth::user()->perfil_id > 1)

            @if (Auth::user()->perfil_id > 2)
            <li>
                <a href="{{route('setor.index')}}" class="nav-link text-white align-middle">
                    <i class="bi bi-archive-fill"></i>
                    <span>Setores</span>
                </a>
            </li>

            @endif

        <li>
            <a href="{{route('assunto.index')}}" class="nav-link text-white align-middle">
                <i class="bi bi-chat-square-quote-fill"></i>
                <span>Assuntos</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.index')}}" class="nav-link text-white align-middle">
                <i class="bi bi-people-fill"></i>
                <span>Usuários</span>
            </a>
        </li>

        @endif
    </ul>
</div>
