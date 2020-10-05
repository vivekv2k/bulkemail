<?php

namespace App\Models\UserDetails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class UserDetails extends Model
{
    use HasFactory,Notifiable;

    protected $table = 'user_email';
    protected $primaryKey='id';
    protected $fillable = ['name','email','contact_number','batch_id','added_user_id'];
    protected $timestamp = false;



}
