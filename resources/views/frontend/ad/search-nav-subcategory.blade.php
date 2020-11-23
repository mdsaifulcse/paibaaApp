
@if(count($adSubCategories)>0)
    @foreach($adSubCategories as $adSubCategory)

        @if(count($adSubCategory->subCatByCat->subCatPrices)>0)
            <a class=" dropdown-btn @if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id) active-category                      @else '' @endif">
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