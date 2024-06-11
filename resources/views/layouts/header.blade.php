<nav class="navbar navbar-expand-lg sticky-top py-3 bg-white">
    <img id="nav-img" src="{{asset('images/header-bg.png')}}">
    <div class="d-flex justify-content-between align-items-center w-100">
        <span id="logo" ><a href="/"><img src="{{asset('images/SiCop-v3.png')}}" width="128px" alt=""></a></span>
        <span id="titulo" class="fs-5 text-white" style="font-weight: bold">Sistema de Controle de Portarias</span>
        <div id="funcoes" class="me-3">
            <span 
            class="text-warning border border-warning px-2 me-2"
            style="font-size: 14px;"
            >{{Auth::user()->perfil->nome}}</span>
            <a id="profile-edit" class="btn btn-opaque-semas-light" href="{{route('profile.edit')}}">
                <div class="d-flex align-items-center justify-content-between">
                    <i class="bi bi-person-circle me-3"></i>
                    <span style="font-size: 14px;">{{ Auth::user()->name }}</span>
                </div>
            </a>
            <a id="logout" class="btn btn-light px-lg-4 ms-2" href="{{route('logout')}}"><i class="bi bi-box-arrow-right me-2"></i><span>Sair</span></a>
        </div>
    </div>
</nav>