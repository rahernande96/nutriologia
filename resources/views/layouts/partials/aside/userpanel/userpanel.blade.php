<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset(Auth::user()->picture) }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="{{ route('config') }}" class="d-block">{{ Auth::user()->name }}</a>
        <span>{{ Auth::user()->rol->rol }}</span>
    </div>
</div>