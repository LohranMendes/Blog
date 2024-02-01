var input, valor , i, menu;

document.addEventListener("DOMContentLoaded", function() {

    input = document.getElementById('pesquisa');
    menu = document.getElementById('menu_search');

    pesquisa = document.getElementById('pesquisa_msg');
    mmsg = document.getElementById('menu_msg');

    if(input != null){
        input.onkeyup = function() {busca()};
        menu.onmouseleave = function() {limparMenu()};
    }

    if(pesquisa != null){
        pesquisa.onkeyup = function() {buscaMenu()};
        mmsg.onmouseleave = function() {limparMenuMsg()};
    }

    function busca() {
        var entrada = input.value.toLowerCase();

        $.ajax({
            type: 'GET',
            url: '/buscaUsuario',
            success(op){
                limparMenu();
                if(entrada != ''){
                    loopBusca(op, entrada);
                }           
            }
        })
    }

    function loopBusca(s, entrada) {
        var div = document.createElement('div');
        div.className = 'absolute z-10 right-2/5 mt-4 bg-white divide-y divide-gray-100 rounded-lg shadow w-auto p-2';
        var html = '<ul>';
    
        for (var i = 0; i < s.length; i++) {
            var u = s[i].usuario.toLowerCase();            
            if (u.indexOf(entrada) > -1 && input.value !== '') {
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

                if (i === s.length - 1) {
                    html += '</ul>';
                }
            }
            else {
                if(html === '<ul>'){
                    if (i === s.length - 1) {
                        html += `<li class="text-gray-500 text-center"> Usuário não encontrado. </li>`
                        html += '</ul>';
                    }
                }
            }
        }
        div.innerHTML = html;
        menu.appendChild(div);
    }

    function buscaMenu() {
        var entrada = pesquisa.value.toLowerCase();
        $.ajax({
            type: 'GET',
            url: '/buscaUsuario',
            success(op){
                limparMenu();
                if(entrada != ''){
                    loopBuscaMenu(op, entrada);
                }           
            }
        })
    }

    function loopBuscaMenu(p, entrada) {
        var div = document.createElement('div');
        div.className = 'absolute z-10 right-7 bottom-8 mt-4 bg-white divide-y divide-gray-100 rounded-lg shadow w-auto p-2';
        var html = '<ul>';
    
        for (var i = 0; i < p.length; i++) {
            var u = p[i].usuario.toLowerCase();            
            if (u.indexOf(entrada) > -1 && pesquisa.value !== '') {
                html += `
                <a href="/mensagem/${p[i].usuario}">
                    <li class="text-md text-blue-500 px-2 py-1 hover:bg-gray-100">
                        <div class="flex items-center mr-2">
                            <div>
                                ${p[i].foto_perfil === 'img/foto-de-perfil-de-usuario.jpg' ? 
                                `<img src="${p[i].foto_perfil}" alt="Foto do Perfil" class="h-12 w-16">`:
                                window.location.href === 'http://' + window.location.hostname + ':8000/inicial' ? 
                                    `<img src="perfil/${p[i].usuario}/fotoperfil" alt="Foto do Perfil" class="h-12 w-16">` :
                                    `<img src="${p[i].usuario}/fotoperfil" alt="Foto do Perfil" class="h-12 w-16">`
                                }
                            </div>
                            <div class="container justify-center">
                                <div>
                                    <span class="ml-2 mr-2 text-color"> ${p[i].nome} ${p[i].sobrenome}</span>
                                </div>
                                <div>
                                    <span class="text-xs mr-2 ml-2 text-color"> ${p[i].usuario}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </a>
                `;

                if (i === p.length - 1) {
                    html += '</ul>';
                }
            }
            else {
                if(html === '<ul>'){
                    if (i === p.length - 1) {
                        html += `<li class="text-gray-500 text-center"> Usuário não encontrado. </li>`
                        html += '</ul>';
                    }
                }
            }
        }
        div.innerHTML = html;
        limparMenuMsg();
        mmsg.appendChild(div);
    }

    function limparMenu(){
        menu.innerHTML = '';
    }

    function limparMenuMsg(){
        mmsg.innerHTML = '';
    }
});