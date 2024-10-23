<?php

namespace Tests\Unit;

use App\Constants\Status;
use App\Models\RpcProvider;
use App\Services\RpcProviderMonitorService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class RpcProviderMonitorServiceTest extends TestCase
{
	use RefreshDatabase;

	protected RpcProviderMonitorService $rpcProviderMonitorService;

	protected function setUp(): void
	{
		parent::setUp();
		$clientMock = Mockery::mock(Client::class);
		$this->rpcProviderMonitorService = new RpcProviderMonitorService($clientMock);
	}


	public function test_monitor_updates_status_to_online()
	{
		//arrange
		$rpcProvider = RpcProvider::factory()->create([
			'url' => 'https://holesky.infura.io/v3/123',
			'name' => 'Infura Test',
			'chain_id' => 'Ethereum',
		]);

		$this->rpcProviderMonitorService->getClient()->shouldReceive('post')
			->once()
			->with($rpcProvider->url, Mockery::any())
			->andReturn(new Response(200, [], json_encode([
				'jsonrpc' => '2.0',
				'id' => 1,
				'result' => '0x277bb8',
			])));

		$expectedStatus = Status::ONLINE;
		$expectedLatency = 0;

		//act
		$this->rpcProviderMonitorService->monitor($rpcProvider);

		//assert
		$this->assertDatabaseHas('rpc_provider_state', [
			'rpc_provider_id' => $rpcProvider->id,
			'status' => $expectedStatus,
			'latency' => $expectedLatency,
		]);
	}

	public function test_monitor_updates_status_to_offline_on_request_exception()
	{
		//arrange
		$rpcProvider = RpcProvider::factory()->create([
			'url' => 'https://holesky.infura.io/v3/123',
			'name' => 'Infura Test',
			'chain_id' => 'Ethereum',
		]);

		$this->rpcProviderMonitorService->getClient()->shouldReceive('post')
			->once()
			->with($rpcProvider->url, Mockery::any())
			->andThrow(new RequestException('API Request failed', new \GuzzleHttp\Psr7\Request('POST', $rpcProvider->url)));

		$expectedStatus = Status::OFFLINE;
		$expectedLatency = 0;

		//act
		$this->rpcProviderMonitorService->monitor($rpcProvider);

		// assert
		$this->assertDatabaseHas('rpc_provider_state', [
			'rpc_provider_id' => $rpcProvider->id,
			'status' => $expectedStatus,
			'latency' => $expectedLatency,
		]);
	}
}
