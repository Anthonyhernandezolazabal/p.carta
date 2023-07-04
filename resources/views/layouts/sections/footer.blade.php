<div id="footer">
    <div class="container text-center">

        @if ($arrFooter != 0)
          @foreach ($arrFooter["datajson"]["footer"] as $row)
              <div class="col-md-4">
                <h3>{{$row["section"]}}</h3>
                <div class="contact-item">
                    @foreach ($row["listas"] as $item)
                      <p>{{$item["detalle"]}}</p>
                    @endforeach
                </div>
              </div>
          @endforeach
        @else
          @for ($i = 1; $i <=4; $i++)
              <div class="col-md-3">
                <h3>Titulo</h3>
                <div class="contact-item">
                    <p>Desc. 01</p>
                    <p>Desc. 02</p>
                    <p>Desc. 03</p>
                    <p>Desc. 04</p>
                </div>
              </div>
          @endfor
        @endif
    </div>
    <div class="container-fluid text-center copyrights">
        <div class="col-md-8 col-md-offset-2">
            <div class="social">
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
            <p>&copy; 2016 Touché. All rights reserved. Designed by <a href="http://www.templatewire.com"
                    rel="nofollow">TemplateWire</a></p>
        </div>
    </div>
</div>
