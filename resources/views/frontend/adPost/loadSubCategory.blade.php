<div class="dashboard_profile_main">
    <div class="dashboard_profile d-flex justify-content-between">
        <div class="profile_setting text-capitalize">
            {{--<h3> Select Sub-Category </h3>--}}
        </div>
    </div>

</div>
<div class="dashboard_menu">
    <ul class="sub-category-list list-unstyled  m-t-20">

        @if(count($subCategories)>0)
            @foreach($subCategories as $data)
                <li id="subCategory{{$data->id}}">
                    <a href="javascript:void(0)" onclick="selectSubCategory({{$data->id}})"> {{$data->sub_category_name}} <span><i class="fa fa-angle-double-right"></i></span>
                    </a>
                </li>
            @endforeach

        @else
            <li><a href="" class="text-danger"><i class="fa fa-warning"></i> No Sub-Category Found !</a></li>
        @endif

    </ul>
</div>