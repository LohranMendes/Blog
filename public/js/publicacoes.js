    var conn = new WebSocket('ws://10.100.214.177:8000');

    conn.onopen = function(e){
        console.log("Conexão estabelecida!");
    }

    function carregarPublicacoes() {
        var publicacoesContainer = document.getElementById('publicacoes');
        publicacoesContainer.innerHTML = '';
    
        novasPublicacoes.forEach(function (publi) {
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
    
    carregarPublicacoes();
    
    setInterval(carregarPublicacoes, 5000);
