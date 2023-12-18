@extends('layout.master')
@section('titulo', 'EsmeraldaBlog - Entre ou Cadastra-se')

@section('conteudo')
    <div class="grid grid-cols-2">
        <div class="col-span-1">
            <div class="tela_altura_titulo flex items-center">
                    <div class="flex items-start flex-col pl-login">
                        <span class="logo_font">EsmeraldaBlog</span>
                        <span class="text-2xl">
                            O EsmeraldaBlog permite criar e compartilhar tópicos interessantes sobre o que gosta com outras pessoas.
                        </span>
                </div>
            </div>
        </div>

        <div class="col-span-1">
            <div class="card mx-auto tela_altura_card w_login  flex items-center justify-center">
                    <form action="{{route('loginPost')}}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="email" class="block"> Email: </label>
                            <input type="email" id="email" name="email" class="block text-sm text-gray-900 mb-2 p-1 rounded-md border border-gray-300 w-full pl-1 hover:bg-gray-50" placeholder="nome@email.com" autocomplete="on" required>
                        </div>
                        <div class="mb-5">
                            <label for="senha" class="block"> Senha: </label>
                            <input type="password" id="senha" name="senha" class="block text-sm text-gray-900 mb-2 p-1 rounded-md border border-gray-300 w-full pl-1 hover:bg-gray-50" placeholder="Senha" required>
                        </div>
                        <div class="mb-5 flex justify-center items-center">
                            <a href="#" class="block">
                                Esqueceu a senha?
                            </a>
                            <button type="submit" class="bg-white botao_auth ml-2 p-2 rounded-md block border border-gray-300 hover:bg-gray-50">  
                                Entrar 
                            </button>
                        </div>
                    </form>
            </div>
            <div class="flex justify-center mt-3">
                <a href="{{route('registro')}}" class="link">Não tem conta? Cadastra-se!</a>
            </div>
        </div>
        
    </div>
@endsection