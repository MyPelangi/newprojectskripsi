<nav class="navbar navbar-expand-lg sticky-top bg-white shadow-sm">
    <a class="navbar-brand" href="/home">
        <img src="/img/logobrins.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/home">Beranda<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/product">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/polis">Polis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link cart" href="/keranjang"><i class="fa-solid fa-cart-shopping"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link profile" href="/profil"><i class="fa-solid fa-user"></i></a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </li>
      </ul>
    </div>
  </nav>
