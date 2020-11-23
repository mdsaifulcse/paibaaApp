<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\Order;
use App\Models\OrderPrice;
use Illuminate\Http\Request;

use Validator,DB,Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $adPostData=AdPost::FindOrFail($request->ad_post_id);

        if (!$request->offer_price){
            return redirect()->back()->with('error','Al lease one price is required');
        }

        $input=$request->all();
        $validator=Validator::make($input,
            [
                'txt_message'=>'required|max:200',
                'attach_file'=>'nullable|mimes:pdf|max:1000',
                'offer_price'=>'required',
            ]
        );

        if ($validator->fails()){
            return redirect()->back()->with('error','Price & Request Message is required');
        }


        DB::beginTransaction();
        try{



            $input['customer_id']=Auth::user()->id;
            $input['post_user_id']=$adPostData->user_id;
            $input['category_id']=$adPostData->category_id;
            $input['status']=0; // 1= Offer, 2= Replay


            if ($request->booking_date_start!=''){
                $input['booking_date_start']=date('Y-m-d',strtotime($request->booking_date_start));
            }
            if ($request->booking_date_end!=''){
                $input['booking_date_end']=date('Y-m-d',strtotime($request->booking_date_end));
            }

            if ($request->hasFile('attach_file')) { // file upload

                if (!is_dir('public\attach_file')) {
                    mkdir('public\attach_file', 0777, true);
                }

                $file = $request->file('attach_file');
                 $uploadPath='attach_file\\'. $file->getClientOriginalName();

                $file->move(base_path('\public\attach_file'), $file->getClientOriginalName());
                $input['attach_file']=$uploadPath;

            }

            //return $input;
            $order=Order::create($input)->id;

            //return $request;
            if ($request->offer_price){
                foreach ($request->offer_price as $key=>$price){
                   OrderPrice::create([
                       'order_id'=>$order,
                       'price_title'=>$key,
                       'price'=>$price,
                   ]);
                }
            }


            $bug=0;
            $error=0;
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            $bug=$e->errorInfo[1];
            $error=$e->errorInfo[2];
        }
        if($bug==0){
            return redirect()->back()->with('success','Data Successfully Saved ');
        }elseif($bug==1451){
            return redirect()->back()->with('error','This ad is Used anywhere ! ');
        }
        elseif($bug>0){
            return redirect()->back()->with('error','Something error found !'.$error);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
