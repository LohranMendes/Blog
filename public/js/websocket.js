import { carregarPublicacoes } from "./publicacoes.js";
import { carregarMensagens } from "./mensagens.js";

class WebSocketConexao {
    constructor(url) {
        if (!WebSocketConexao.instance) {
            this.socket = new WebSocket(url);
            this.socket.onopen = () => {
                if(window.location.href === 'http://' + window.location.hostname + ':8000/perfil/' + usuario.usuario){
                    const sinal = {
                        status: 'ativo',
                        pagina: 'perfil',
                        usuario: usuario.id,   
                    };
                    this.send(JSON.stringify(sinal));
                }
                else {
                    const sinal = {
                        status: 'ativo',
                        pagina: 'outros',
                    };
                    this.send(JSON.stringify(sinal));
                }
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
            carregarPublicacoes(retorno.publicacoes);
        }

        if(retorno.tipo === 'publi'){
            if ('atualizado' in retorno) {
                var p = retorno.publicacoes;
            } else {
                var p = publicacoes;
            }
            carregarPublicacoes(p);
        }

        if(retorno.tipo === 'mensagem'){
            if('atualizado' in retorno){
                let m = retorno.msgs;
                carregarMensagens(m);
                console.log(m);
            }
            else {
                let m = retorno.msgs;
                console.log(m);
                carregarMensagens(m);
                console.log(m);
            }
        }
    }
  }
  
  const inst = new WebSocketConexao('ws://10.100.214.177:8002');
  export { inst as conn };