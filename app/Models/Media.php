<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    
    public function by(){
    	return User::find($this->by);
    }
}
