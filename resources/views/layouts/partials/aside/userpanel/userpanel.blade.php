<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ Auth::user()->picture == "default.png" ? asset('default.png') : Storage::url(Auth::user()->picture) }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="{{ route('config') }}" class="d-block">{{ Auth::user()->name }}</a>
        <strong>{{ Auth::user()->rol->rol == "Doctor" ? "nutriólogo" : Auth::user()->rol->rol }}</strong>
    </div>
</div>