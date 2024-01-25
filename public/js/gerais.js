var input, valor , i, menu;

document.addEventListener("DOMContentLoaded", function() {

    input = document.getElementById('pesquisa');
    menu = document.getElementById('menu_search');

    if(input != null){
        input.onkeyup = function() {busca()};
        menu.onmouseleave = function() {limparMenu()};
        
        function busca() {
            var entrada = input.value.toLowerCase();

            $.ajax({
                type: 'GET',
                url: '/buscaUsuario',
                success(op){
                    limparMenu();
                    if(entrada != ''){
                        var s = JSON.parse(op);
                        loopBusca(s, entrada);
                    }           
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

                if (i === s.length - 1) {
                    html += '</ul>';
                }
                
                html += `
                <a href="/perfil/${s[i].usuario}">
                    <li class="text-md text-blue-500 px-2 py-1 hover:bg-gray-100">
                        <div class="flex items-center mr-2">
                            <div>
                                ${s[i].foto_perfil === 'img/foto-de-perfil-de-usuario.jpg' ? 
                                `<img src="${s[i].foto_perfil}" alt="Foto do Perfil" class="h-12 w-16">`:
                                window.location.href === 'http://' + window.location.hostname + ':8000/inicial' ? 
                                    `<img src="perfil/${s[i].usuario}/fotoperfil" alt="Foto do Perfil" class="h-12 w-16">` :
                                    `<img src="${s[i].usuario}/fotoperfil" alt="Foto do Perfil" class="h-12 w-16">`
                                }
                            </div>
                            <div class="container justify-center">
                                <div>
                                    <span class="ml-2 mr-2 text-color"> ${s[i].nome} ${s[i].sobrenome}</span>
                                </div>
                                <div>
                                    <span class="text-xs mr-2 ml-2 text-color"> ${s[i].usuario}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </a>
                `;
            }
        }
    
        div.innerHTML = html;
        menu.appendChild(div);
    }

    function limparMenu(){
        menu.innerHTML = '';
    }

    $('#menu_search').on('click', function(){
        console.log("Fui clicado.");
    })
});