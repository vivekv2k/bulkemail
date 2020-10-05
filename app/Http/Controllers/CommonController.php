<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{

    private function filterLoop($q,$arr,$att,$val){
        $keys = array_keys(array_column($arr,$att), $val);
        if(count($keys)>0){
            for($i=0;$i<count($keys);$i++){
                $flt=$arr[$keys[$i]]['filter'];
                $rel=$arr[$keys[$i]]['rel'];
                $q->whereHas($rel, function($q) use ($flt,$rel,$arr) {
                    $q->where($flt);
                    $this->filterLoop($q,$arr,'parent',$rel);
                });
            }
        }
        return $q;
    }

    protected function setFeildArrays($filter,$ret_arr){
        if($filter['operator']=='LIKE'){
            switch ($filter['search']){
                case 'left':
                    $val=trim($filter['feild_name']).'%';
                    break;
                case 'right':
                    $val='%'.trim($filter['feild_name']);
                    break;
                default :
                    $val='%'.trim($filter['feild_name']).'%';
                    break;
            }
        }
        else{
            $val=trim($filter['feild_name']);
        }
        if($filter['type']=='int'){
            if($filter['feild_name']!=''){
                $ret_arr[]=[$filter['column_name'],$filter['operator'],$val];
            }
        }
        else{
            if($filter['feild_name']!='' || $filter['feild_name']!=NULL){
                $ret_arr[]=[$filter['column_name'],$filter['operator'],$val];
            }
        }

        return $ret_arr;
    }

    public function getData($param){
        if($param['model']!=""){
            $query=$param['model'];

            /*if($param['relations']!=''){
                $query=$query->with($param['relations']);
            }*/

            if(count($param['relations'])>0){
                for ($r=0;$r<count($param['relations']);$r++){
                    $query=$query->with($param['relations'][$r]);
                }
            }

            if(count($param['conditions'])>0){
                $query=$query->where($param['conditions']);
            }

            if(count($param['filter_arr'])>0){
                $filter_fld=$param['filter_fld'];
                $filter_arr=$param['filter_arr'];
                $query=$query->when($filter_fld, function ($q) use ($filter_fld,$filter_arr) {
                    if(!empty($filter_arr)){
                        $q=$q->where($filter_arr[0]['filter']);
                        $q=$this->filterLoop($q,$filter_arr,'parent','master');
                    }
                    return $q;
                });
            }

            if(count($param['order_by'])>0){
                foreach ($param['order_by'] as $ord){
                    $query=$query->orderBy($ord['column'], $ord['direction']);
                }
            }

            return $query->get();
        }
        else{
            return NULL;
        }
    }
}
