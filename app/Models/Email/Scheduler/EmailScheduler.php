<?php

namespace App\Models\Email\Scheduler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Batch\Batch;

class EmailScheduler extends Model
{
    use HasFactory;

    protected $table = 'email_scheduler';
    protected $primaryKey='id';
    protected $timestamp = false;
    protected $fillable = ['email_alias','email_subject','email_body','email_attach_file','send_date'];
    

    public function batch(){

        return  $this->belongsToMany(Batch::class,'email_scheduler_user_batch','email_scheduler_id', 'user_batch_id');
        //dd($set);

    }

}
