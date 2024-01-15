<?php

namespace App\Http\Controllers;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\publicacaoModel;
use App\Models\User;

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
        $banco = [];

        if(isset($data['status']) && $data['status'] === 'ativo'){
            $confirma = ['status' => 'confirmacao'];

            foreach ($this->clients as $client) {
                $client->send(json_encode($confirma));
            }
        }

        if (isset($data['tipo']) && $data['tipo'] === 'novaPublicacao') {
            $banco['id_usuario'] = User::where('usuario', $data['usuario'])->value('id_usuario');
            $banco['text'] = $data['texto'];
            publicacaoModel::create($banco);

            $posts = new publicacaoModel;
            $publicacoes = $posts->postsUsuarios();
            $atualizado = 1;
            $dados = compact('publicacoes', 'atualizado');

            foreach ($this->clients as $client) {
                $client->send(json_encode($dados));
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
