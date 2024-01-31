<?php

namespace App\Http\Controllers;

use App\Models\conversaModel;
use App\Models\mensagemModel;
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
            $status = 'confirmacao';
            $post = new publicacaoModel;
            $publicacoes = $post->postsUsuarios();

            $dados = compact('publicacoes', 'status');

            foreach ($this->clients as $client) {
                $client->send(json_encode($dados));
            }
        }

        if (isset($data['tipo']) && $data['tipo'] === 'novaPublicacao') {
            $banco['id_usuario'] = User::where('usuario', $data['usuario'])->value('id_usuario');
            $banco['text'] = $data['texto'];
            publicacaoModel::create($banco);

            $post = new publicacaoModel;
            $publicacoes = $post->postsUsuarios();
            $atualizado = 1;
            $tipo = 'publi';
            $dados = compact('publicacoes', 'atualizado', 'tipo');

            foreach ($this->clients as $client) {
                $client->send(json_encode($dados));
            }
        }

        if(isset($data['tipo']) && $data['tipo'] === 'excluir'){
            publicacaoModel::where('id_publi', $data['id_publi'])->delete();

            $posts = new publicacaoModel;
            $publicacoes = $posts->postsUsuarios();
            
            $atualizado = 2;
            $tipo = 'publi';
            $conteudo = compact('publicacoes', 'atualizado', 'tipo');
    
            foreach ($this->clients as $client) {
                $client->send(json_encode($conteudo));
            }
        }

        if(isset($data['tipo']) && $data['tipo'] === 'mensagem'){
            if(!conversaModel::where(['de_id_usuario' => $data['de_usuario'], 'para_id_usuario' => $data['para_usuario']])->exists()){
                $bancoConversa['de_id_usuario'] = $data['de_usuario'];
                $bancoConversa['para_id_usuario'] = $data['para_usuario'];
                conversaModel::create($bancoConversa);

                $id = conversaModel::where(['de_id_usuario' => $data['de_usuario'], 'para_id_usuario' => $data['para_usuario']])->value('id_chat');
                $bancoMensagem['id_chat'] = $id;
                $bancoMensagem['id_usuario'] = $data['de_usuario'];
                $bancoMensagem['text'] = $data['msg'];
                mensagemModel::create($bancoMensagem);
            }
            else {
                $id = conversaModel::where(['de_id_usuario' => $data['de_usuario'], 'para_id_usuario' => $data['para_usuario']])->value('id_chat');
                $bancoMensagem['id_chat'] = $id;
                $bancoMensagem['id_usuario'] = $data['de_usuario'];
                $bancoMensagem['text'] = $data['msg'];
                mensagemModel::create($bancoMensagem);
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
