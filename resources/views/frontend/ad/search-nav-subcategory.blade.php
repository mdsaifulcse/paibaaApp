
<ul class="nav nav-pills">

    @forelse($adSubCategories as $key=>$adSubCategory)

        <li class="dropdown">

            @if(count($adSubCategory->subCatByCat->subCatPrices)>0)

                <a href="{{URL::to("ads/$location/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)}}" class="dropdown-toggle @if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id) active-category @else '' @endif">
                    {{$adSubCategory->subCatByCat->sub_category_name}}
                    ({{number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)}})
                    <b class="caret"></b></a>

                <ul class="dropdown-menu dropdown-container" id="menu1{{$key}}">
                    @foreach($adSubCategory->subCatByCat->subCatPrices as $priceData)
                        <li>
                            <a href="{{URL::to("ads/$location/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id."&pricetitle=$priceData->price_title")}}">
                                {{$priceData->price_title}} </a>
                        </li>
                    @endforeach
                </ul>

            @else
                <a class="@if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id) active-category @else '' @endif"
                   href="{{URL::to("ads/$location/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)}}">
                    {{$adSubCategory->subCatByCat->sub_category_name}}
                    @if(!empty($adSubCategory->subCatByCat->totalSubCatAd))
                        ({{number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)}})
                    @else
                        0
                    @endif
                </a>
            @endif

        </li>

    @empty
        <li class="">
            <a href="javascript:void(0)" class="dropdown-toggle">No Data Found !</a>

        </li>
    @endforelse
</ul>