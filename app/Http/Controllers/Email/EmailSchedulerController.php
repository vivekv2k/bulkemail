<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails\UserDetails;
use App\Notifications\BulkEmail;
use Illuminate\Http\Request;
USE App\Models\Email\Scheduler\EmailScheduler;
use App\Models\Batch\Batch;
use \Illuminate\Notifications\Notifiable;
use App\Http\Controllers\CommonController;

class EmailSchedulerController extends CommonController
{

    public function index(){
        $emailScheduler = EmailScheduler::with('batch')->get();
        return view('email.scheduler.index',compact('emailScheduler'));
    }
    public function create(){

        $userBatch =Batch::get();
        return view('email.scheduler.create',compact('userBatch'));
    }

    public function store(Request $request){

            //Load Model
            $emailScheduler = new EmailScheduler();

            $emailScheduler->email_alias = $request->email_alias;
            $emailScheduler->email_subject = $request->email_subject;
            $emailScheduler->email_body = $request->email_body;
            $emailScheduler->email_attach_file = $request->email_attach_file;
            $emailScheduler->send_date = $request->send_date;
            $emailScheduler->send_status = 0;

            //exploade the batch values
            $expBatchValues = explode(",",$request->batch_values);

            //looping multiple batch values
            $emailScheduler->save();
            for($i=0; $i<count($expBatchValues); $i++){
                $emailScheduler->batch()->attach($expBatchValues[$i]);
            }
    }



    public function sendEmail(Request $request , $id){

        $emailScheduler = EmailScheduler::with('batch')->where('id',$id)->get();
        foreach ($emailScheduler as $scheduler){
            foreach ($scheduler->batch as $data){
                $batchId  = $data->batch_id;
                $userBatch = UserDetails::where('batch_id',$batchId)->get();
                foreach ($userBatch as $user){
                    $user->notify(new BulkEmail($user));
                }
            }
        }
    }
}
