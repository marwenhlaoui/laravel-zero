<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "service";

    public function access(){
    	return json_decode($this->access);
    }

    public function users($value=null){
        $data =  \DB::table('service_user')->where('service',$this->id)->get();
        $list = [];
        if(!empty($value)){ 
            foreach ($data as $key => $item) {
                $list[] = $item->$value;
            }
            $data = $list;
        }
        return $data;
    }

    public function have($id){
        $have = \DB::table('service_user')->where(['service'=>$this->id,'user'=>$id])->first();
        return (!empty($have->id)) ? true : false ;

    }
 
}
