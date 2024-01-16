@extends('layout.master')
@section('titulo', 'Registre-se no EsmeraldaBlog | EsmeraldaBlog')

@section('conteudo')
<div class="block">
    <div class="card tela_altura_card_2 w-2/5 mx-auto flex items-center justify-center">
        <div class="block">
            <span class="text-2xl ml-10">Registre-se!</span>
            <hr class="mb-3 ml-3 mr-3 mt-2">
            <form action="{{route('registroPost')}}" method="POST">
                @csrf
                <div class="grid grid-cols-2 mb-3 fs-sml">
                    <div class="ml-15">
                        <label for="nomepessoa" class="block pl-1"> Nome: </label>
                        <input type="text" id="nomepessoa" name="nomepessoa" class="block fs-sml pl-1 p-1 text-gray-900 rounded-md w-89 hover:bg-gray-50" placeholder="Digite seu nome" required>
                    </div>
                    
                    <div class="pl-1">
                        <label for="sobrenome" class="block"> Sobrenome: </label>
                        <input type="text" id="sobrenome" name="sobrenome" class="block fs-sml pl-1 p-1 text-gray-900 rounded-md w-78 hover:bg-gray-50" placeholder="Digite seu sobrenome" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 mb-3 fs-sml">
                    <div class="ml-15">
                        <label for="apelido" class="block"> Usuário: </label>
                        <input type="text" id="apelido" name="apelido" class="block fs-sml pl-1 p-1 text-gray-900 rounded-md w-89 hover:bg-gray-50" placeholder="Digite seu apelido" required>
                    </div>
                    <div class="pl-1">
                        <label for="nascimento" class="block "> Nascimento: </label>
                        <input type="date" id="nascimento" name="nascimento" class="block fs-sml p-1 text-gray-900 rounded-md w-78 hover:bg-gray-50" required>
                    </div>
                </div>
                <div class="mb-3 ml-7-5 fs-sml">
                    <label for="email" class="block"> Email: </label>
                    <input type="email" id="email" name="email" class="block fs-sml text-gray-900 pl-1 p-1 rounded-md w-89 hover:bg-gray-50" placeholder="email@exemplo.com" autocomplete="on" required>
                </div>
                <div class="grid grid-cols-2 mb-3 fs-sml">
                    <div class="ml-15">
                        <label for="senha" class="block"> Senha: </label>
                        <input type="password" id="senha" name="senha" class="rounded-md fs-sml pl-1 p-1 text-gray-900 w-89 hover:bg-gray-50" placeholder="Digite sua senha" required>
                    </div>
                    <div class="pl-1">
                        <label for="csenha" class=""> Confirmar Senha: </label>
                        <input type="password" id="csenha" name="csenha" class="rounded-md fs-sml pl-1 p-1 text-gray-900 w-78 hover:bg-gray-50" placeholder="Confirme sua senha" required>
                    </div>
                </div>
                <div class="flex justify-end mr-16 mt-7 mb-2 fs-sml">
                    <button type="submit" class="bg-white botao_auth rounded-md p-1 hover:bg-gray-50 border border-gray-300">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex justify-center mt-3">
        <a href="{{route('login')}}" class="link fs-sml">Tem uma conta? Faça login!</a>
    </div>
        @if(session('error'))
        <div class="flex justify-center mt-3">
            <div class="flex bg-red-400 rounded-md text-white p-2 text-sm shadow-sm">
                <i class="bi bi-exclamation-triangle"></i> 
                <span class="font-medium ml-1 pr-1">Atenção! </span> {{ session('error') }}
            </div>
        </div>
        @endif

        @if($errors->has('csenha') || $errors->has('senha'))
            @if($errors->has('csenha'))
                <div class="flex justify-center mt-2">
                    <div class="flex bg-red-400 rounded-md text-white p-2 text-sm shadow-sm">
                        <span class="text-white mb-1">
                            <i class="bi bi-exclamation-triangle pr-1"></i> {{ $errors->first('csenha') }}
                        </span>
                    </div>
                </div>
            @endif
        
            @if($errors->has('senha'))
                <div class="flex justify-center mt-2">
                    <div class="flex bg-red-400 rounded-md text-white p-2 text-sm shadow-sm">
                        <span class="text-white">
                            <i class="bi bi-exclamation-triangle pr-1"></i> {{ $errors->first('senha') }}
                        </span>
                    </div>
                </div>
            @endif
        @endif
</div>
@endsection