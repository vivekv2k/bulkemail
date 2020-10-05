<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Jobs\SendScheduleEmail;
use App\Models\User;
use App\Notifications\BulkEmail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use App\Excel\Download\UsersDetailsPreFormatExcel;
use App\Excel\Import\impUsersDetailsExcelSheet;
use Carbon\Carbon;
use App\Models\System\Batch\BatchNumber;
use App\Models\Batch\Batch;
use Illuminate\Support\Facades\Auth;


class EmailManagerController extends Controller
{
    public function index(){

        return view('email.index');
    }

    public function getPreFormatExcel(){

        return Excel::download(new UsersDetailsPreFormatExcel, 'user.xlsx');
    }

    public function impExcelSheet(Request $request){

        // generate batch number eg batch reference number
            $getToDay = Carbon::now();
            $getBatchPrex = 'CYB';
            $getCurrentYear = date('Y');
            $setBatchType = 'TRAINING';
            $getMonth = '0';
            $setLoginUser = '1';

        // generate batch reference number common class
            $BatchNo = BatchNumber::generateRef($getBatchPrex,6,$setBatchType,$getCurrentYear,$getMonth);

        //save batch number to intermidiate table we an use it in email sacdualer to send bulk email
            if($BatchNo != NULL){
                $generateBatchDetails = new Batch();
                $generateBatchDetails->batch_no = $BatchNo;
                $generateBatchDetails->save();

                $generateBatchDetails::where('batch_no',$BatchNo)->get();
                $setBatchId = $generateBatchDetails->batch_id;
            }

        //import excel sheet and save to database
        return Excel::import(new impUsersDetailsExcelSheet($setBatchId,$setLoginUser), $request->file('file')->store('temp'));
        return redirect('/email/manager/view');
    }


}
