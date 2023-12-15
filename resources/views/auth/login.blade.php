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
            <div class="card mx-auto flex justify-center items-center tela_altura_card w_login">
                <form>
                    <div class="mb-5">
                        <label for="email" class="block"> Email: </label>
                        <input type="email" id="email" class="block text-gray-900 mb-2 p-1 rounded-md border border-gray-300 w-full pl-1" placeholder="nome@email.com" required>
                    </div>
                    <div class="mb-5">
                        <label for="senha" class="block"> Senha: </label>
                        <input type="password" id="senha" class="block text-gray-900 mb-2 p-1 rounded-md border border-gray-300 w-full pl-1" placeholder="Senha" required>
                    </div>
                    <div class="mb-5 flex justify-center items-center">
                        <a href="#" class="block">
                            Esqueceu a senha?
                        </a>
                        <button type="submit" class="bg-white botao_login  ml-2 p-2 rounded-md block border border-gray-300">  
                            Entrar 
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex justify-center mt-3">
                <a href="{{route('registro')}}">Não tem conta? Cadastra-se!</a>
            </div>
        </div>
        
    </div>
@endsection