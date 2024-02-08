<?php

namespace App\Http\Controllers;

use App\Models\conversaModel;
use App\Models\mensagemModel;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Models\publicacaoModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            $dados = compact('status');
            foreach ($this->clients as $client) {
                $client->send(json_encode($dados));
            }
        }

        if(isset($data['tipo']) && $data['tipo'] === 'carregarPublicacoesPerfil'){
            $u = User::where('id_usuario', $data['id'])->value('usuario');
            $post = new publicacaoModel;
            $publicacoes = $post->postUsuario($u);

            $atualizado = 1;
            $alerta = 'carregando';

            $dados = compact('alerta', 'publicacoes', 'atualizado');
            foreach ($this->clients as $client) {
                if ($client === $conn) { 
                    $client->send(json_encode($dados));
                    break; 
                }
            }
        }

        if (isset($data['tipo']) && $data['tipo'] === 'novaPublicacaoPerfil') {
            $banco['id_usuario'] = User::where('usuario', $data['usuario'])->value('id_usuario');
            $banco['text'] = $data['texto'];
            publicacaoModel::create($banco);

            $post = new publicacaoModel;
            $publicacoes = $post->postUsuario($data['usuario']);
            $atualizado = 1;
            $tipo = 'publiPerfil';
            $dados = compact('publicacoes', 'atualizado', 'tipo');

            foreach ($this->clients as $client) {
                if ($client === $conn) { 
                    $client->send(json_encode($dados));
                    break; 
                }
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
            if(array_key_exists('pagina', $data) && $data['pagina'] === 'perfil'){
                publicacaoModel::where('id_publi', $data['id_publi'])->delete();

                $posts = new publicacaoModel;
                $publicacoes = $posts->postUsuario($data['usuario']);
                
                $atualizado = 1;
                $tipo = 'publi';
                $conteudo = compact('publicacoes', 'atualizado', 'tipo');
        
                foreach ($this->clients as $client) {
                    $client->send(json_encode($conteudo));
                }
            }
            else {
                publicacaoModel::where('id_publi', $data['id_publi'])->delete();

                $posts = new publicacaoModel;
                $publicacoes = $posts->postsUsuarios();
                
                $atualizado = 1;
                $tipo = 'publi';
                $conteudo = compact('publicacoes', 'atualizado', 'tipo');
        
                foreach ($this->clients as $client) {
                    $client->send(json_encode($conteudo));
                }
            }
        }

        if(isset($data['tipo']) && $data['tipo'] === 'mensagem'){
            $usuarios = [$data['de_usuario'], $data['para_usuario']];
            sort($usuarios); 
            if(!conversaModel::where(['de_id_usuario' => $usuarios[0], 'para_id_usuario' => $usuarios[1]])->exists()) {
                $bancoConversa['de_id_usuario'] = $usuarios[0];
                $bancoConversa['para_id_usuario'] = $usuarios[1];
                conversaModel::create($bancoConversa);

                $id = conversaModel::where(['de_id_usuario' => $usuarios[0], 'para_id_usuario' => $usuarios[1]])->value('id_chat');
                $bancoMensagem['id_chat'] = $id;
                $bancoMensagem['id_usuario'] = $data['de_usuario'];
                $bancoMensagem['text'] = $data['msg'];
                mensagemModel::create($bancoMensagem);

                conversaModel::where('id_chat', $id)->update(['updated_at' => $data['tempo']]);

                $msg = new mensagemModel;
                $msgs = $msg->mensagensChat($usuarios[0], $usuarios[1]);

                $atualizado = 1;
                $tipo = 'mensagem';
                $conteudo = compact('msgs', 'atualizado', 'tipo');

                foreach ($this->clients as $client) {
                    $client->send(json_encode($conteudo));
                }
            }
            else {
                $id = conversaModel::where(['de_id_usuario' => $usuarios[0], 'para_id_usuario' => $usuarios[1]])->value('id_chat');
                $bancoMensagem['id_chat'] = $id;
                $bancoMensagem['id_usuario'] = $data['de_usuario'];
                $bancoMensagem['text'] = $data['msg'];
                mensagemModel::create($bancoMensagem);

                $msg = new mensagemModel;
                $msgs = $msg->mensagensChat($usuarios[0], $usuarios[1]);

                conversaModel::where('id_chat', $id)->update(['updated_at' => $data['tempo']]);

                $atualizado = 1;
                $tipo = 'mensagem';
                $conteudo = compact('msgs', 'atualizado', 'tipo');

                foreach ($this->clients as $client) {
                    $client->send(json_encode($conteudo));
                }
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
