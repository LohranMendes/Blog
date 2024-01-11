
    function carregarPublicacoes() {
        var novasPublicacoes = [
            { usuario: 'NovoUsuário', text: 'Nova publicação', foto_perfil: 'img/nova-foto.jpg' },
        ];

        var publicacoesContainer = document.getElementById('publicacoes');
        publicacoesContainer.innerHTML = '';

        novasPublicacoes.forEach(function (publi) {
            var div = document.createElement('div');
            div.className = 'mt-2';

            var html = `
                <div class="border-cor border-post-style border-post-w ml-2">
                    <div class="ml-2">
                    @if($publi->foto_perfil == 'img/foto-de-perfil-de-usuario.jpg')
                        <img src="{{ url($publi->foto_perfil) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">
                    @else
                        <img src="{{ route('imagem', ['usuario' => $publi->usuario]) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">
                    @endif
                    <a href={{route('perfil', ['usuario' => $publi->usuario])}} class="text-color">
                        {{$publi->usuario}}
                    </a>
                </div>
                <div class="text-xs mb-4 ml-2 mt-1">
                    {{$publi->text}}
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
