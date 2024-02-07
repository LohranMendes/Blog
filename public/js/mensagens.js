import {conn} from './websocket.js'

function carregarMensagens(m) {
    let area_msgContainer = document.getElementById('area_mensagem');
    if(area_msgContainer != null && idChat === m[0].chat) { 
        area_msgContainer.innerHTML = '';

        m.forEach(function (mensagem) {
            let div = document.createElement('div');
            div.className = 'mt-2';
                if(id === mensagem.id_de){
                    var html = `
                        <div class="grid grid-cols-6">
                            <div class="col-span-5 col-start-2 mr-1 mb-2">
                                <div class="flex justify-end px-2">
                                    <span class="text-xs font-bold">${mensagem.de}</span>
                                </div>
                                <div class="bg-green-100 border border-cor text-black rounded-md px-2 py-4">
                                    ${mensagem.mensagem}
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    var html = `
                        <div class="grid grid-cols-6">
                            <div class="col-span-5 ml-1 mb-2">
                                <div class="flex justify-start px-2">
                                    <span class="text-xs font-bold">${mensagem.de}</span>
                                </div>
                                <div class="bg-white border border-cor text-black rounded-md px-2 py-4">
                                    ${mensagem.mensagem}
                                </div>
                            </div>
                        </div>
                    `;
                }
            
            
            div.innerHTML = html;
            area_msgContainer.appendChild(div);
        });

        area_msgContainer.scrollTop = area_msgContainer.scrollHeight;
    }
}

function CarregarConversas(c){
    let area_cvsContainer = document.getElementById('conversas_recentes');
    if(area_cvsContainer != null) { 
        area_cvsContainer.innerHTML = '';

        c.forEach(function (conversa) {
            let div = document.createElement('div');
            div.className = 'mt-2';

            var html = `
                    <div>
                        <div class="m-3 p-3 border border-cor hover:bg-gray-100">
                            <a href="/mensagem/${id}/${conversa.u}">
                                <img src="/perfil/${conversa.u}/fotoperfil" alt="Foto do Perfil" class="h-8 w-8 inline-block">
                                <span> ${conversa.u} </span>
                            </a>
                        </div>
                    </div>
            `;

            div.innerHTML = html;
            area_cvsContainer.appendChild(div);
        });
    }
}

function Inicial(){
    let usuarios = [u.id_usuario, id];
    usuarios = usuarios.sort();

    $.ajax({
        type: 'GET',
        url: "/mensagens/" +  usuarios[0] + "/" + usuarios[1],
        success(op){
            carregarMensagens(op);
        } 
    })

    $.ajax({
        type: 'GET',
        url: "/conversas/" +  id,
        success(c){
            CarregarConversas(c);
        } 
    })
}

document.addEventListener("DOMContentLoaded", function(){
    let form = document.getElementById('form_msg');
    let input = document.getElementById('input_msg');
    const tempo = new Date();

    Inicial();

    if(form != null){
        form.addEventListener("submit", function(e){
            e.preventDefault();

            if(input.value !== ''){
                const mss = {
                    tipo: 'mensagem',
                    de_usuario: id,
                    para_usuario:  u.id_usuario,
                    msg: input.value,
                    tempo: tempo.toLocaleDateString('pt-BR').split('/').reverse().join('-') + " " + tempo.toLocaleTimeString('pt-BR'), 
                }

                if(mss.msg.length <= 1000){
                    conn.send(JSON.stringify(mss));
                    input.value = '';
                }
            }
        })
    }
})

export { carregarMensagens };