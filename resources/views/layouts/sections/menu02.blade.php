<div id="restaurant-menu">
    <div class="section-title text-center center">
        <div class="overlay">
            <h2>{{ $arrMenu02 !=0 ? $arrMenu02["datajson"]["img_title_desc"]["title"] : 'MENÚ' }}</h2>
            <hr>
            <p>{{ $arrMenu02 !=0 ? $arrMenu02["datajson"]["img_title_desc"]["desc"] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit duis sed.' }}</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @if ($arrMenu02 != 0)
                @foreach ($arrMenu02["datajson"]["carta"] as $row)
                    <div class="col-xs-12 col-sm-6">
                        <div class="menu-section">
                            <h2 class="menu-section-title">{{ $arrMenu02 !=0 ? $row["section"] : 'Breakfast & Starters' }}</h2>
                            <hr>
                            @foreach ($row["listas"] as $item)

                                <div class="menu-item">
                                    <div class="menu-item-name"> {{$item["title"]}} </div>
                                    <div class="menu-item-price"> S/{{$item["price"]}} </div>
                                    <div class="menu-item-description"> {{$item["detalle"]}} </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
</div>
