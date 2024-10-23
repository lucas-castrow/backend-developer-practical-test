<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RpcProviderState extends Model
{
    protected $table = 'rpc_provider_state';
    public $incrementing = false;
    protected $primaryKey = 'rpc_provider_id';

    use HasFactory;

    protected $fillable = [
        'rpc_provider_id',
        'status',
        'latency',
    ];

    public function rpcProvider()
    {
        return $this->belongsTo(RpcProvider::class, 'rpc_provider_id');
    }
}
