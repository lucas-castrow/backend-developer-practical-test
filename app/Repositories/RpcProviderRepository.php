<?php

namespace App\Repositories;

use App\Models\RpcProvider;
use App\Interfaces\RpcProviderInterface;

class RpcProviderRepository implements RpcProviderInterface
{

    public function all()
    {
        return RpcProvider::all();
    }

    public function store(array $data)
    {
        return RpcProvider::create($data);
    }

    public function update(array $data, $id)
    {
        return RpcProvider::whereId($id)->update($data);
    }

    public function delete($id)
    {
        RpcProvider::destroy($id);
    }

    public function find($id)
    {
        return RpcProvider::find($id);
    }
}
