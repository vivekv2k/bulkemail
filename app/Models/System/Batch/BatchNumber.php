<?php

namespace App\Models\System\Batch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchNumber extends Model
{
    use HasFactory;

    protected $table = 'sys_ref_numbers';

    protected $fillable = [

         'ref_type',
         'ref_year',
         'ref_month',
         'ref_prfx',
         'ref_nxt_seq'
    ];
    protected $timestamp = false;

    public static function generateRef($prefix,$length,$type,$year,$month){

            $allocate_ref = 1;
            $ref_array = array(

                'ref_type' => $type,
                'ref_year' => $year,
                'ref_month' => $month,
                'ref_prfx' => $prefix,
                'ref_nxt_seq' => $allocate_ref
            );

            $ref = self::select(array('id','ref_nxt_seq'))
                        ->where('ref_type', '=', $ref_array['ref_type'])
                        ->where('ref_year', '=', $ref_array['ref_year'])
                        ->where('ref_month', '=', $ref_array['ref_month'])
                        ->first();

            //update
            if(!empty($ref)){

                $allocate_ref = $ref->ref_nxt_seq;
                $ref->ref_nxt_seq = $allocate_ref + 1;

                $ref->save();
            }else{

                $allocate_ref = 1;
                $ref_array['ref_nxt_seq']=2;
                self::create($ref_array);
            }

            if($ref_array['ref_month'] == '00'){
                $pref_ref=$prefix.$ref_array['ref_year'];
            }else{
                $pref_ref = $prefix.$ref_array['ref_year'].$ref_array['ref_month'];
            }

            $assigned_ref_no = $pref_ref.str_pad($allocate_ref, $length, "0", STR_PAD_LEFT);
            return $assigned_ref_no;
    }
}
