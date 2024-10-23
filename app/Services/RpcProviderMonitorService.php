<?php

namespace App\Services;

use App\Constants\Status;
use App\Models\RpcProvider;
use App\Models\RpcProviderState;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class RpcProviderMonitorService
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function getClient(): Client
	{
		return $this->client;
	}
	public function monitor()
	{
		$providers = RpcProvider::all();
		Log::info("Monitoring RPC Provider State for " . count($providers) . " providers");

		foreach ($providers as $rpcProvider) {

			Log::info('Monitorinf RPC Provider State for ID: ' . $rpcProvider->id);

			$url = $rpcProvider->url;
			$status = Status::OFFLINE;
			$latency = null;

			$payload = [
				'jsonrpc' => '2.0',
				'method' => 'eth_blockNumber',
				'params' => [],
				'id' => 1,
			];

			try {
				$start = microtime(true);
				$response = $this->client->post($url, [
					'json' => $payload,
					'timeout' => 5,
				]);
				$latency = (microtime(true) - $start) * 1000;
				$status = Status::ONLINE;

				Log::info('RPC Provider is online', [
					'rpc_provider_id' => $rpcProvider->id,
					'latency' => $latency,
					'response' => json_decode($response->getBody(), true),
				]);
			} catch (RequestException $e) {
				Log::error('Request error for RPC Provider', [
					'rpc_provider_id' => $rpcProvider->id,
					'error' => $e->getMessage(),
				]);
			} catch (ConnectException $e) {
				Log::error('Connection error for RPC Provider', [
					'rpc_provider_id' => $rpcProvider->id,
					'error' => $e->getMessage(),
				]);
			} catch (\Exception $e) {
				Log::error('Unexpected error for RPC Provider', [
					'rpc_provider_id' => $rpcProvider->id,
					'error' => $e->getMessage(),
				]);
			}

			RpcProviderState::updateOrCreate(
				['rpc_provider_id' => $rpcProvider->id],
				[
					'status' => $status,
					'latency' => round($latency),
				]
			);
		}
	}
}
