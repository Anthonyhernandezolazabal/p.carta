<header id="header">
    <div class="intro">
      <div class="overlay">
        <div class="container">
          <div class="row">
            <div class="intro-text">
                <h1>{{ ($header->count() != 0) ? $header[0]->titulo : 'Título' }}</h1>
                <p>{{ ($header->count() != 0) ? $header[0]->descripcion : 'Descripción' }}</p>
              <a href="#about" class="btn btn-custom btn-lg page-scroll">Discover Story</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>