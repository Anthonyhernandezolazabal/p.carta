<nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
          data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span
            class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand page-scroll" href="#page-top" style="{{ $arrLogoNombres !=0 ? 'padding:0 !important' : 'padding:15px 15px !important' }}">
            @if ($arrLogoNombres == 0)
            Logo
            @else
            <img src="{{ $arrLogoNombres !=0 ? $arrLogoNombres["path"] : 'vendor/img/user-1-118x118.jpg'}}" width="100">
            @endif
        </a>
    </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#about" class="page-scroll">{{ $arrMenuNombres !=0 ? $arrMenuNombres["menu01"] : 'MENÚ 01'}}</a></li>
          <li><a href="#restaurant-menu" class="page-scroll">{{ $arrMenuNombres !=0 ? $arrMenuNombres["menu02"] : 'MENÚ 02'}}</a></li>
          <li><a href="#portfolio" class="page-scroll">{{ $arrMenuNombres !=0 ? $arrMenuNombres["menu03"] : 'MENÚ 03'}}</a></li>
          <li><a href="#team" class="page-scroll">{{ $arrMenuNombres !=0 ? $arrMenuNombres["menu04"] : 'MENÚ 04'}}</a></li>
          <li><a href="#call-reservation" class="page-scroll">{{ $arrMenuNombres !=0 ? $arrMenuNombres["menu05"] : 'MENÚ 05'}}</a></li>
        </ul>
      </div>
    </div>
  </nav>