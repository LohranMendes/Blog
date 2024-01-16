function mostrarModal(){
    const modal = document.getElementById('perfil-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function fecharModal(){
    const modal = document.getElementById('perfil-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}