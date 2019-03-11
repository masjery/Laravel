<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //table
    protected $table ='posts';
    //primary key
    public $primarykey ='id';
    //timestamps
    public $timestamps = true;
    
    public function user(){
        
        return $this->belongsTO('App\User');
    }
}
