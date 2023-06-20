<div id="about">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-6 ">
            <div class="about-img">
                <img src="{{ $arrMenu01 !=0 ? $arrMenu01["datajson"]["img"] : 'vendor/img/index-3-556x382.jpg'}}" class="img-responsive" alt="">
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="about-text">
            <h2>
                {{ $arrMenu01 !=0 ? $arrMenu01["datajson"]["titulo"] : 'OUR RESTAURANT'}}
            </h2>
            <hr>


            @if ($arrMenu01 == 0)
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed
                commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam commodo nibh.
                </p>
                <h3>Awarded Chefs</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam. Sed
                commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare.</p>
            @else

                {!! $arrMenu01["datajson"]["estructura"] !!}

            @endif



          </div>
        </div>
      </div>
    </div>
  </div>
