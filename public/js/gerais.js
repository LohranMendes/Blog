var input, valor , i, menu;

document.addEventListener("DOMContentLoaded", function() {

    input = document.getElementById('pesquisa');
    menu = document.getElementById('menu_search');

    if(input != null){
        input.onkeyup = function() {busca()};

        input.onblur = function() {limparMenu()};
        
        function busca() {
            var entrada = input.value.toLowerCase();

            $.ajax({
                type: 'GET',
                url: '/buscaUsuario',
                success(op){
                    limparMenu();
                    var s = JSON.parse(op);
                    loopBusca(s, entrada);           
                }
            })
        }
    }

    function loopBusca(s, entrada) {
        var div = document.createElement('div');
        div.className = 'absolute z-10 right-48 mt-4 bg-white divide-y divide-gray-100 rounded-lg shadow w-56 p-2';
        var html = '<ul>';
    
        for (var i = 0; i < s.length; i++) {
            var u = s[i].usuario.toLowerCase();
            
            if (u.indexOf(entrada) > -1 && input.value !== '') {
                html += `
                    <a href="perfil/${s[i].usuario}">
                        <li class="text-md text-blue-500 px-2 py-1 hover:bg-gray-100">
                            <div class="inline-flex items-center">
                                <div>
                                    ${s[i].foto_perfil === 'img/foto-de-perfil-de-usuario.jpg' ? 
                                    `<img src="${s[i].foto_perfil}" alt="Foto do Perfil" class="h-12 w-12 mr-6">`:
                                    window.location.href === 'http://' + window.location.hostname + ':8000/inicial' ? 
                                        `<img src="perfil/${s[i].usuario}/fotoperfil" alt="Foto do Perfil" class="h-12 w-12 mr-6">` :
                                        `<img src="${s[i].usuario}/fotoperfil" alt="Foto do Perfil" class="h-12 w-12 mr-6">`
                                     }
                                </div>
                                <div>
                                    <span class="mr-2"> ${s[i].nome} ${s[i].sobrenome}</span>
                                    <span class="text-xs mr-2"> ${s[i].usuario}</span>
                                </div>
                            </div>
                        </li>
                    </a>
                `;
    
                if (i === s.length - 1) {
                    html += '</ul>';
                }
            }
        }
    
        div.innerHTML = html;
        menu.appendChild(div);
    }

    function limparMenu(){
        menu.innerHTML = '';
    }
});