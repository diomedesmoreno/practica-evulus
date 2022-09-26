<?php

namespace App\Models;

use App\Database\CustomQueryBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
	// use SoftDeletes;

    protected $appends = [];
    protected $attributes = [];
  
    public function addAppends($moreAppendsProperties = null)
    {
        if(is_array($moreAppendsProperties))
        {
            foreach ($moreAppendsProperties as $append) {
                array_push($this->appends, $append);
            }
        }else{
            array_push($this->appends, $moreAppendsProperties);
        }
    }

    public function addAttributes($moreAttributesProperties = null)
    {   
        if(is_array($moreAttributesProperties))
        {
            foreach ($moreAttributesProperties as $key => $value) {
                $this->attributes[$key] = $value;
            }
        }       
    }
    
}
