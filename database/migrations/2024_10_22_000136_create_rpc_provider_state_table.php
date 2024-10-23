<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//TODO: update rpc providers state to be stored in cache (redis/nats KV)
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rpc_provider_state', function (Blueprint $table) {
            $table->uuid('rpc_provider_id')->primary();
            $table->integer('status');
            $table->unsignedInteger('latency')->nullable();
            $table->timestamps();
            $table->foreign('rpc_provider_id')->references('id')->on('rpc_providers')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rpc_provider_state');
    }
};
