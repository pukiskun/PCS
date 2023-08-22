{{-- <nav class="navbar navbar-expand-md navbar-dark bg-white">
    <div class="container">
        <a href="#" class="navbar-brand mb-0 h1"><img class="img-thumbnail" src="{{Vite::asset('resources/images/logo.png') }}" alt="image"> Data Master</a>

        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <hr class="d-md-none text-white-50">

            <ul class="navbar-nav flex-row flex-wrap">
                <li class="nav-item col-2 col-md-auto"><a href="#">Home</a></li>
                <li class="nav-item col-2 col-md-auto"><a href="#">Employee</a></li>
            </ul>

            <hr class="d-md-none text-white-50">


            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-person-circle me-1"></i> Administrator</a>
                        {{ Auth::user()->name }}s

                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>--}}

{{-- <nav class="navbar navbar-expand-md navbar-dark bg-white">
    <div class="container">
        <a href="#" class="navbar-brand mb-0 h1"><img class="img-thumbnail" src="{{Vite::asset('resources/images/logo.png') }}" alt="image"> Data Master</a>
--}}
<nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img class="img-thumbnail" src="{{Vite::asset('resources/images/logo.png') }}" alt="logo petrokopindo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
