<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class RpcProvider extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'name', 'chain_id'];


    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        //generates an uuid when new data is created
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
    public function rpcProviderState()
    {
        return $this->hasOne(RpcProviderState::class);
    }
}
