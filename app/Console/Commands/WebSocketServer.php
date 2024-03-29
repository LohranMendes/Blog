<?php

namespace App\Console\Commands;

use App\Http\Controllers\SocketController;
use Illuminate\Console\Command;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Loop;

class WebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketController()
                )
            ),
            8002,
        );

        $logger = app('log')->channel('websocket');
        $server->loop->addPeriodicTimer(1, function () use ($logger) {
        $logger->debug('WebSocket server is running.');
});

        $server->run();
    }
}
