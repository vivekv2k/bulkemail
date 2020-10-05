<?php

namespace App\Models\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email\Scheduler\EmailScheduler;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'user_batch';
    protected $primaryKey='batch_id';
    protected $timestamp = false;
    protected $fillable = ['batch_no'];


    public function email(){

        return $this->belongsToMany(EmailScheduler::class,'email_scheduler_user_batch','user_batch_id','email_scheduler_id');
    }

}
