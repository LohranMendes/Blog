import {conn} from './websocket.js';

function carregarPublicacoesPerfil(p) {
    var publicacoesContainer = document.getElementById('publicacoesPerfil');
    if(publicacoesContainer != null){
        publicacoesContainer.innerHTML = '';
        
        p.forEach(function (publi) {
            var div = document.createElement('div');
            div.className = 'mt-2';

            var html = `
                    <div class="border-cor border-post-style border-post-w">
                        <div class="ml-2 flex items-center">
                            ${publi.foto_perfil === 'img/foto-de-perfil-de-usuario.jpg' ? 
                                `<img src="${publi.foto_perfil}" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">` :
                                window.location.href === 'http://' + window.location.hostname + ':8000/inicial' ? 
                                    `<img src="perfil/${publi.usuario}/fotoperfil" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">` :
                                    `<img src="${publi.usuario}/fotoperfil" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">`
                            }
                            <div class="flex justify-between w-full">
                                    ${window.location.href === 'http://' + window.location.hostname + ':8000/perfil/' + publi.usuario ?
                                        `<a href=${publi.usuario} class="text-color ml-2">${publi.usuario}</a>` :
                                        `<a href=perfil/${publi.usuario} class="text-color ml-2">${publi.usuario}</a>`}
                                    ${publi.id_usuario === id ?
                                        `<button type="button" class="btn_excluir">
                                            <i class="bi bi-trash mr-2 text-red-600"></i>
                                        </button>` : ''}
                                </div>
                        </div>
                        <div class="text-xs mb-4 ml-2 mt-1">
                            ${publi.text}
                        </div>
                        <div class="bg-gray-100 text-xs flex items-center pr-2 rounded-sm h-6 text-color">
                            <span class="mr-2 ml-2">
                                <i class="bi bi-heart"></i>
                                Curtir
                            </span>
                            <span class="mr-2"> 
                                <i class="bi bi-chat-left"></i>
                                Comentar 
                            </span>
                            <span>
                                <i class="bi bi-share"></i>
                                Compartilhar
                            </span>
                        </div>
                    </div>`;      

                
            div.innerHTML = html;
            publicacoesContainer.appendChild(div);

            $(div).find('.btn_excluir').on('click', function(){
                if(window.location.href === 'http://' + window.location.hostname + ':8000/perfil/' + usuario.usuario){
                    const excluir = {
                        tipo: 'excluirPerfil',
                        id_publi: publi.id_publi,
                        usuario: publi.usuario,
                    }

                    conn.send(JSON.stringify(excluir));
                }
            });
        });
    }
}


document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formPubliPerfil");
    var textarea = document.getElementById("publiPerfil");

    if(formulario != null){
        formulario.addEventListener("submit", function(event) {
            event.preventDefault();

            if(document.getElementById("publiPerfil").value !== ''){
                    const padrao = {
                    tipo: 'novaPublicacaoPerfil',
                    usuario: usuario.usuario,
                    texto: document.getElementById("publiPerfil").value,
                }
                    if(padrao.texto.length <= 255){
                        conn.send(JSON.stringify(padrao));
                        textarea.value = '';
                    }
            }
        });
    }
        setTimeout(carregarPublis, 50)
});

function carregarPublis() {
    if (conn.socket.readyState === WebSocket.OPEN) {
        const sinal = {
            tipo: 'carregarPublicacoesPerfil',
            id: usuario.id_usuario,
        };
        conn.send(JSON.stringify(sinal));
    } else {
        console.error('WebSocket não está pronto para enviar mensagens.');
    }
}

export { carregarPublicacoesPerfil };