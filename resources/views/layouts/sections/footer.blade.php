<div id="footer">
    <div class="container text-center ft_01">

        @if ($arrFooter != 0)
          @foreach ($arrFooter["datajson"]["footer"] as $row)
              <div class="col-md-3" style="margin: auto;">
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
                    @foreach ($arrFooter02["datajson"] as $item)
                        <li><a href="{{ $item['url'] }}" target="_blank"><i class="fa {{ $item['icon'] }}"></i></a></li>
                    @endforeach
                </ul>
            </div>

            <p>{{ $arrFooter02 !=0 ? $arrFooter02["copy"] : '&copy; 2016 Touché. All rights reserved. Designed by TemplateWire'}}</p>
        </div>
    </div>
</div>
