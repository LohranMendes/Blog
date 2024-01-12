<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Http\Controllers\PublicacaoController;

class SocketController extends Controller implements MessageComponentInterface
{
    protected $clients;

    public function __construct(){
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $data = json_decode($msg, true);

        if (isset($data['action']) && $data['action'] === 'create') {
            $publication = Publication::create([
                'user_id' => $data['user_id'],
                'content' => $data['content'],
            ]);

            foreach ($this->clients as $client) {
                $client->send(json_encode($publication));
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Ocorreu um erro: {$e->getMessage()}\n";
        $conn->close();
    }
}
