<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subnet extends Model
{
    //Allows us to not hard delete everything
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'site_id','subnet_address', 'mask_bits','vLan','lease_time'];

    //Specifying the join relationships
    public function site(){
        return $this->belongsTo('App\Site');
    }
    public function notes(){
        return $this->morphMany('App\Note', 'noteable');
    }
   
}
