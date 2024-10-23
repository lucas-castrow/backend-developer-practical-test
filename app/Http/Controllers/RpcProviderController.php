<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Resources\RpcProviderResource;
use App\Interfaces\RpcProviderInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RpcProviderController extends Controller
{
    private RpcProviderInterface $rpcProviderInterface;

    public function __construct(RpcProviderInterface $service)
    {
        $this->rpcProviderInterface = $service;
    }

    public function index(Request $request)
    {
        $status = $request->query('status');
        $chainId = $request->query('chain_id');

        $query = $this->rpcProviderInterface->all()->load('rpcProviderState');

        if (isset($status)) {
            $query = $query->where('rpcProviderState.status', $status);
        }

        if ($chainId) {
            $query = $query->where('chain_id', $chainId);
        }

        return ApiResponseClass::sendResponse(RpcProviderResource::collection($query), '', 200);
    }

    public function store(Request $request)
    {
        $rpcData = [
            'url' => $request->url,
            'name' => $request->name,
            'chain_id' => $request->chain_id,
        ];
        DB::beginTransaction();
        try {
            $rpcProvider = $this->rpcProviderInterface->store($rpcData);

            DB::commit();
            return ApiResponseClass::sendResponse(new RpcProviderResource($rpcProvider), 'RPC provider added successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function update(Request $request, $id)
    {
        $updateRpcData = [
            'url' => $request->url,
            'name' => $request->name,
            'chain_id' => $request->chain_id,
        ];
        DB::beginTransaction();

        try {
            $rpcProvider = $this->rpcProviderInterface->find($id);

            if (!$rpcProvider) {
                return ApiResponseClass::sendResponse('Provider not found with ID: ' . $id, 'RPC provider not found', 404);
            }

            $rpcProvider = $this->rpcProviderInterface->update($updateRpcData, $id);

            DB::commit();
            return ApiResponseClass::sendResponse('', 'RPC provider updated successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $rpcProvider = $this->rpcProviderInterface->find($id);

            if (!$rpcProvider) {
                return ApiResponseClass::sendResponse('Provider not found with ID: ' . $id, 'RPC provider not found', 404);
            }

            $this->rpcProviderInterface->delete($id);

            DB::commit();
            return ApiResponseClass::sendResponse(new RpcProviderResource($rpcProvider), 'RPC provider deleted successfully', 200);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }
}
