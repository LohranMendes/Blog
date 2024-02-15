import { carregarPublicacoes } from "./publicacoes.js";
import { carregarMensagens } from "./mensagens.js";
import { carregarPublicacoesPerfil } from "./perfil.js";

class WebSocketConexao {
    constructor(url) {
        if (!WebSocketConexao.instance) {
            this.socket = new WebSocket(url);
            this.socket.onopen = () => {
                    const sinal = {
                    status: 'ativo',
                    }
                    this.send(JSON.stringify(sinal));
            };
        
            this.socket.onclose = () => {
                    console.log('WebSocket está fechado.');
            };
        
            this.socket.onerror = (error) => {
                console.error(`Erro no WebSocket: ${error}`);
            };
        
            this.socket.onmessage = (event) => {
                this.handleMessage(event.data);
            };

            WebSocketConexao.instance = this;
        }
    
        return WebSocketConexao.instance;
    }
  
    send(msg) {
        this.socket.send(msg);
    }
  
    handleMessage(msg) {
        const retorno = JSON.parse(msg);

        if(retorno.status === 'confirmacao'){
            console.log(retorno);
            if(window.location.href === 'http://' + window.location.hostname + ':8000/inicial'){
                $.ajax({
                    type: 'GET',
                    url: '/publicacoesdeusuarios',
                    success(op){
                        console.log(op);
                        carregarPublicacoes(op);
                    }
                })
            }
        }

        if(retorno.alerta === 'carregando'){
            if ('atualizado' in retorno) {
                var p = retorno.publicacoes;
            } else {
                var p = publicacoes;
            }
            carregarPublicacoesPerfil(p);
        }

        if(retorno.tipo === 'publiPerfil'){
            console.log("novapubli");
            if ('atualizado' in retorno) {
                var p = retorno.publicacoes;
            } else {
                var p = publicacoes;
            }
            carregarPublicacoesPerfil(p);
        }

        if(retorno.tipo === 'publiPerfil'){
            if ('atualizado' in retorno) {
                var p = retorno.publicacoes;
            } else {
                var p = publicacoes;
            }
            carregarPublicacoes(p);
        }

        if(retorno.tipo === 'publi'){
            if ('atualizado' in retorno) {
                var p = retorno.publicacoes;
                console.log(1);
            } else {
                var p = publicacoes;
            }
            carregarPublicacoes(p);
        }

        if(retorno.tipo === 'mensagem'){
            if('atualizado' in retorno){
                let m = retorno.msgs;
                carregarMensagens(m);
            }
            else {
                let m = retorno.msgs;
                carregarMensagens(m);
            }
        }
    }
  }
  
  const inst = new WebSocketConexao('ws://10.100.214.177:8002');
  export { inst as conn };