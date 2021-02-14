@section('style')

@endsection


<div class="sidenav">

    <div class="sidebar-wrapper">

        <div class="single-sidebar">
            <?php $routeName=explode('/',Request::path())?>
            @if($routeName[0]=='price' ||$routeName[0]=='tag')
                <span></span>
                @else
                    <form class="search-form" onsubmit="return false" >
                        <input placeholder="Category search" type="text" id="catKeywords" autocomplete="off">
                        <button type="button" id="findCategory"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <ul id="searchKeywordUl0" style="margin-bottom:0rem;"></ul>
                    </form>

                @endif
        </div>

    <div id="categoryResult">

    </div>

    <div id="showDefaultCategory" style="display: none">
        <a href="javascript:void(0)" style="background-color: #663e4c;text-align: center;"> Show category </a>
    </div>

    <div id="defaultCategory">

        <ul class="nav nav-pills">
            <li class="dropdown">
                <a href="{{url('/sdhfhkjs')}}" class="dropdown-toggle">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu" id="menu1">
                    <li><a href="#">Separated link</a></li>
                </ul>
            </li>
        </ul>


        @if(count($adSubCategories)>0)
            @foreach($adSubCategories as $adSubCategory)

                @if(count($adSubCategory->subCatByCat->subCatPrices)>0)
                    <a class=" dropdown-btn @if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id) active-category @else '' @endif">
                        {{$adSubCategory->subCatByCat->sub_category_name}}
                        ({{number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)}})
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <div class="dropdown-container">
                        @foreach($adSubCategory->subCatByCat->subCatPrices as $priceData)
                            <a href="{{URL::to('ads/bangladesh/'.$category->link.'?subcategory='.$adSubCategory->subCatByCat->id."&pricetitle=$priceData->price_title")}}">
                                {{$priceData->price_title}} </a>
                        @endforeach
                    </div>

                @else
                    <a class="@if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id) active-category @else '' @endif"
                       href="{{URL::to('ads/bangladesh/'.$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)}}">
                        {{$adSubCategory->subCatByCat->sub_category_name}}
                        @if(!empty($adSubCategory->subCatByCat->totalSubCatAd))
                            ({{number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)}})
                        @else
                            0
                        @endif
                    </a>

                @endif

            @endforeach
        @else
            <a href="javascript:void(0)"> No Sub-subcategory  </a>
        @endif
    </div>

</div>

<div class="single-sidebar mt-4">
    <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/google_adds1.png" alt="Classified Plus">
</div>

</div>

