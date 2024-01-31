import { carregarPublicacoes } from "./publicacoes.js";

class WebSocketConexao {
    constructor(url) {
        if (!WebSocketConexao.instance) {
            this.socket = new WebSocket(url);
        
            this.socket.onopen = () => {
                const sinal = {
                status: 'ativo',
                };
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
    }
  }
  
  const inst = new WebSocketConexao('ws://localhost:8002');
  export { inst as conn };