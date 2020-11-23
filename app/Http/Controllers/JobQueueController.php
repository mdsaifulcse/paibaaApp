<?php

namespace App\Http\Controllers;

use App\Events\NewCustomerHasRegisteredEvent;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobQueueController extends Controller
{
    public function index(){
        $eventMsg='Test Event Message';

        event(new NewCustomerHasRegisteredEvent($eventMsg));

        return 'Event Email Successfully Send !';



//        $job=(new SendEmailJob())->delay(Carbon::now()->addSeconds(5));
//
//        dispatch($job);
//
//        return 'job Email Successfully Send !';


    }
}
