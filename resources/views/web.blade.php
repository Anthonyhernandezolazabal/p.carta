<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons
      ================================================== -->
    <link rel="shortcut icon" href="vendor/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="vendor/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="vendor/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="vendor/img/apple-touch-icon-114x114.png">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="vendor/fonts/font-awesome/css/font-awesome.css">

    <!-- Stylesheet
      ================================================== -->
    <link rel="stylesheet" type="text/css" href="vendor/css/style.css">
    <link rel="stylesheet" type="text/css" href="vendor/css/nivo-lightbox/nivo-lightbox.css">
    <link rel="stylesheet" type="text/css" href="vendor/css/nivo-lightbox/default.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">
    <style>
        .intro {
            display: table;
            width: 100%;
            padding: 0;
            @if ($header->count() > 0)
                background: url({{ $header[0]->filename }}) no-repeat center center;
            @else
                background: url(vendor/img/slider-4-slide-1-1920x678.jpg) no-repeat center center;
            @endif
            background-color: #e5e5e5;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }

        #restaurant-menu .section-title {
            background: #444 url({{ $arrMenu02 !=0 ? $arrMenu02["datajson"]["img_title_desc"]["img"] : 'vendor/img/menu-bg.jpg' }}) center center no-repeat fixed;
            background-size: cover;
        }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    @include('layouts.sections.nav')
    @include('layouts.sections.slider')
    @include('layouts.sections.menu01')
    @include('layouts.sections.menu02')
    <div id="portfolio">
        <div class="section-title text-center center">
        <div class="overlay">
            <h2>Gallery</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
        </div>
        </div>
        <div class="container">
        <div class="row">
            <div class="categories">
            <ul class="cat">
                <li>
                <ol class="type">
                    <li><a href="#" data-filter="*" class="active">All</a></li>
                    <li><a href="#" data-filter=".breakfast">Breakfast</a></li>
                    <li><a href="#" data-filter=".lunch">Lunch</a></li>
                    <li><a href="#" data-filter=".dinner">Dinner</a></li>
                </ol>
                </li>
            </ul>
            <div class="clearfix"></div>
            </div>
        </div>
        <div class="row">
            <div class="portfolio-items">
            <div class="col-sm-6 col-md-4 col-lg-4 breakfast">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/01-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/01-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 dinner">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/02-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/02-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 breakfast">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/03-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/03-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 breakfast">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/04-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/04-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 dinner">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/05-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/05-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 lunch">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/06-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/06-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 lunch">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/07-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/07-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 breakfast">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/08-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/08-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 dinner">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/09-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/09-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 lunch">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/10-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/10-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 lunch">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/11-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/11-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 breakfast">
                <div class="portfolio-item">
                <div class="hover-bg"> <a href="vendor/img/portfolio/12-large.jpg" title="Dish Name"
                    data-lightbox-gallery="gallery1">
                    <div class="hover-text">
                        <h4>Dish Name</h4>
                    </div>
                    <img src="vendor/img/portfolio/12-small.jpg" class="img-responsive" alt="Project Title">
                    </a> </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div id="team" class="text-center">
        <div class="overlay">
        <div class="container">
            <div class="col-md-10 col-md-offset-1 section-title">
            <h2>Meet Our Chefs</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed dapibus leonec.</p>
            </div>
            <div id="row">
            <div class="col-md-4 team">
                <div class="thumbnail">
                <div class="team-img"><img src="vendor/img/team/01.jpg" alt="..."></div>
                <div class="caption">
                    <h3>Mike Doe</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 team">
                <div class="thumbnail">
                <div class="team-img"><img src="vendor/img/team/02.jpg" alt="..."></div>
                <div class="caption">
                    <h3>Chris Doe</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.</p>
                </div>
                </div>
            </div>
            <div class="col-md-4 team">
                <div class="thumbnail">
                <div class="team-img"><img src="vendor/img/team/03.jpg" alt="..."></div>
                <div class="caption">
                    <h3>Ethan Doe</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div id="call-reservation" class="text-center">
        <div class="container">
        <h2>Want to make a reservation? Call <strong>1-887-654-3210</strong></h2>
        </div>
    </div>
    <div id="contact" class="text-center">
        <div class="container">
        <div class="section-title text-center">
            <h2>Contact Form</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.</p>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <form name="sentMessage" id="contactForm" novalidate>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <input type="text" id="name" class="form-control" placeholder="Name" required="required">
                    <p class="help-block text-danger"></p>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <input type="email" id="email" class="form-control" placeholder="Email" required="required">
                    <p class="help-block text-danger"></p>
                </div>
                </div>
            </div>
            <div class="form-group">
                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message"
                required></textarea>
                <p class="help-block text-danger"></p>
            </div>
            <div id="success"></div>
            <button type="submit" class="btn btn-custom btn-lg">Send Message</button>
            </form>
        </div>
        </div>
    </div>
    @include('layouts.sections.footer')
  <script type="text/javascript" src="vendor/js/jquery.1.11.1.js"></script>
  <script type="text/javascript" src="vendor/js/bootstrap.js"></script>
  <script type="text/javascript" src="vendor/js/SmoothScroll.js"></script>
  <script type="text/javascript" src="vendor/js/nivo-lightbox.js"></script>
  <script type="text/javascript" src="vendor/js/jquery.isotope.js"></script>
  <script type="text/javascript" src="vendor/js/jqBootstrapValidation.js"></script>
  <script type="text/javascript" src="vendor/js/contact_me.js"></script>
  <script type="text/javascript" src="vendor/js/main.js"></script>

</body>

</html>
