var conn = new WebSocket('ws://localhost:8002');
var atualizado = 0;

conn.onopen = function(e){
    console.log("Conexão estabelecida!");

    const sinal = {
        status: 'ativo',
    };

    conn.send(JSON.stringify(sinal));
}

conn.onmessage = function(e){

    const retorno = JSON.parse(e.data);

    console.log(retorno.atualizado);

    if('atualizado' in retorno){
        var p = retorno.publicacoes;
    }
    else {
        var p = publicacoes; 
    }

    function carregarPublicacoes(p) {
        var publicacoesContainer = document.getElementById('publicacoes');
        publicacoesContainer.innerHTML = '';
    
        p.forEach(function (publi) {
            var div = document.createElement('div');
            div.className = 'mt-2';
    
            var html = `
                <div class="border-cor border-post-style border-post-w">
                    <div class="ml-2">
                    ${publi.foto_perfil === 'img/foto-de-perfil-de-usuario.jpg' ? `
                        <img src="${publi.foto_perfil}" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">
                    ` : `
                        <img src="perfil/${publi.usuario}/fotoperfil" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">
                    `}
                        <a href=perfil/${publi.usuario} class="text-color">${publi.usuario}</a>
                    </div>
                    <div class="text-xs mb-4 ml-2 mt-1">
                        ${publi.text}
                    </div>
                    <div class="bg-gray-100 text-xs flex items-center pr-2 rounded-sm h-6 text-color">
                        <span class="mr-2 ml-2">
                            <i class="bi bi-heart-fill"></i>
                            Curtir
                        </span>
                        <span class="mr-2"> 
                            <i class="bi bi-chat-left-fill"></i>
                            Comentar 
                        </span>
                        <span>
                            <i class="bi bi-share-fill"></i>
                            Compartilhar
                        </span>
                    </div>
                </div>
            `;
    
            div.innerHTML = html;
            publicacoesContainer.appendChild(div);
        });
    }

    carregarPublicacoes(p);
}

conn.onerror = function (e) {
    console.error('WebSocket Error:', e);
};

conn.onclose = function (e) {
    console.log('WebSocket Closed:', e);
};

document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.getElementById("formPubli");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();

        if(document.getElementById("publi").value === ''){
            console.log('é vazio');
        }
        else {
            const padrao = {
                tipo: 'novaPublicacao',
                usuario: usuario.usuario,
                texto: document.getElementById("publi").value,
            }

            conn.send(JSON.stringify(padrao));
        }
    });
});

