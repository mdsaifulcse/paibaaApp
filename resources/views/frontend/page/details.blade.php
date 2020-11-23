@extends('frontend.master')

@section('title')
 {{$pageDetails->title}}   | Paibaa | Khojleye Paibaa | Shob Paibaa
@endsection


@section('content')

    <section class="featured_ads bg-light">
        <div class="container">
            <!-- Row  -->
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="title"></h2>
                </div>
            </div>
            <!-- Row  -->
            <div class="row">
                <div class="col-lg-8 col-md-81">
                    <div class="jumbotron">
                        <h4 class="m-b-20">{{$pageDetails->title}}</h4>

                        <?php echo $pageDetails->description;?>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Featured_ads -->





@endsection

@section('script')
@endsection