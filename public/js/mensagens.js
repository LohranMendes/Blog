import {conn} from './websocket.js'

document.addEventListener("DOMContentLoaded", function(){
    let form = document.getElementById('form_msg');
    let input = document.getElementById('input_msg');

    if(form != null){
        form.addEventListener("submit", function(e){
            e.preventDefault();

            if(input.value !== ''){
                const mss = {
                    tipo: 'mensagem',
                    de_usuario: id,
                    para_usuario:  u.id_usuario,
                    msg : input.value,
                }

                if(mss.msg.length <= 1000){
                    conn.send(JSON.stringify(mss));
                    input.value = '';
                }
            }
        })
    }
})