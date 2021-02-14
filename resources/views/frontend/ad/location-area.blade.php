<div class="container">
    <div class="row m-t-10 margin_top">

        <div class="col-md-2 col-sm-12 col-xs-12">
            <h6 class="text-right m-t-10">Location</h6>
        </div>

        <div class="col-md-10 col-sm-12 col-xs-12">
            <div class="scrollmenu">

                <div id="locationResult">

                </div>

                <a id="showDefaultLocation" style="display: none;background-color: #663e4c;text-align: center;" href="javascript:void(0)" style="background-color: #663e4c;text-align: center;"> Show Location </a>


                <div id="defaultLocation">
                    <?php
                    $routeName=explode('/',Request::path());
                    $locationName=Request::segment(2);
                    ?>
                    @if($routeName[0]=='price' ||$routeName[0]=='tag')
                        <span></span>
                    @else
                    <form class="search-form" style="display: inline-table;" onsubmit="return false">
                        <input placeholder="Location search" type="text" id="locationKeyword">
                        <button type="button" id="findLocation" style="cursor: pointer"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                    @endif

                @if(count($categoryWiseLocations)>0)

                        @foreach($categoryWiseLocations as $location)
                            @if($locationName==$location->locationByCat->url)
                            <a class="active" href="{{URL::to('ads/'.$location->locationByCat->url.'/'.$category->link)}}">{{$location->locationByCat->location_name}} </a>
                                @else
                                    <a class="" href="{{URL::to('ads/'.$location->locationByCat->url.'/'.$category->link)}}">{{$location->locationByCat->location_name}}</a>
                                @endif
                        @endforeach
                    @else
                        <a href="javascript:void(0)"> No Location </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>