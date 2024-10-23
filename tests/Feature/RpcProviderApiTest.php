<?php

namespace Tests\Feature;

use App\Models\RpcProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RpcProviderApiTest extends TestCase
{
	use RefreshDatabase;

	public function test_create_rpc_provider()
	{
		// arrange
		$data = [
			'url' => 'https://holesky.infura.io/v3/123',
			'name' => 'Provider Test',
			'chain_id' => 'Binance Smart Chain',
		];

		// act
		$response = $this->post('/api/provider', $data);

		// assert
		$response->assertStatus(201)
			->assertJson(['message' => 'RPC provider added successfully']);
		$this->assertDatabaseHas('rpc_providers', $data);
	}

	public function test_update_rpc_provider()
	{
		//arrange
		$rpcProvider = RpcProvider::factory()->create([
			'url' => 'https://binance.chain.io/v3/123',
			'name' => 'Renamed provider',
			'chain_id' => 'Ethereum',
		]);


		$data = ['name' => 'Updated Provider', 'chain_id' => 'Ethereum', 'url' => 'https://binance.chain.io/v3/123'];

		// act
		$response = $this->put('/api/provider/' . $rpcProvider->id, $data);

		// assert
		$response->assertStatus(201)
			->assertJson(['message' => 'RPC provider updated successfully']);
		$this->assertDatabaseHas('rpc_providers', ['name' => 'Updated Provider']);
	}

	public function test_update_fail_rpc_provider()
	{
		//arrange
		$fictiousId = '123e4567-e89b-12d3-a456-426614174000';

		$data = ['name' => 'Updated Provider', 'chain_id' => 'Ethereum', 'url' => 'https://binance.chain.io/v3/123'];

		// act
		$response = $this->put('/api/provider/' . $fictiousId, $data);

		// assert
		$response->assertStatus(404)
			->assertJson(['message' => 'RPC provider not found']);
	}

	public function test_delete_rpc_provider()
	{
		//arrange
		$rpcProvider = RpcProvider::factory()->create([
			'url' => 'https://optimism-sepolia.infura.io/v3/456',
			'name' => 'Example Provider',
			'chain_id' => '1',
		]);

		//act
		$response = $this->delete('/api/provider/' . $rpcProvider->id);

		// assert
		$response->assertStatus(200)
			->assertJson(['message' => 'RPC provider deleted successfully']);
		$this->assertDatabaseMissing('rpc_providers', ['id' => $rpcProvider->id]);
	}

	public function test_delete_fail_rpc_provider()
	{
		// arrange
		$fictiousId = '123e4567-e89b-12d3-a456-426614174000';

		// act
		$response = $this->delete('/api/provider/' . $fictiousId);

		// assert
		$response->assertStatus(404)
			->assertJson(['message' => 'RPC provider not found']);
	}

	public function test_fetch_rpc_providers()
	{
		// arrange
		RpcProvider::factory()->count(4)->create();

		// act
		$response = $this->get('/api/provider');

		// assert
		$response->assertStatus(200)
			->assertJsonCount(4, 'data');
	}
}
