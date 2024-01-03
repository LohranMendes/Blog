@extends('layout.master')
@section('titulo', 'Página Inicial')

@section('conteudo')
    <div class=" h-visor grid grid-cols-8">
        <div class="col-span-1 bg-gray-perfil border-homebar"></div>

        <div class="col-span-6">
            <div class="bg-gray-800 h-banner-perfil relative flex items-center text-2xl">
                <div class="w-full justify-between">
                    <div class="h-20 w-20 absolute bottom-5 left-8 border-cor border-w inline-flex items-center text-white ">
                        <img src="{{ url($u['foto_perfil']) }}" alt="Foto do Perfil">
                        <span class="pl-2"> {{$u['nome']}} </span>
                        <span class="pl-2"> {{$u['sobrenome']}} </span>
                    </div>
                    <div class="h-15 w-50 absolute bottom-10 right-8 items-center text-white ">
                        <button type="button" class="rounded-md border-cor border p-1 text-base">
                            Editar Perfil
                        </button>
                    </div>
                </div>
            </div>

            @if(Auth::id() == $u->id_usuario)
                <div class="ml-2 mr-2 mt-2">
                    <form action={{route('pp')}} method="POST">
                        @csrf
                        <div class="border-cor border-post-style border-post-w ">
                            <label for="publi" class="text-form-post  mb-1 pl-2"> Crie um novo tópico! </label>
                            <hr class="w-full border-cor mb-2">
                            <textarea id="publi" name="publi" class="block text-sm pb-5 px-2 w-full rounded-md text-post-1" placeholder="Digite aqui"></textarea>
                            <div class="bg-gray-100 flex justify-end pr-2 rounded-sm">
                                <button type="submit" name="pperfil" class="btn-cor btn-font-size text-white p-1 my-2 rounded-md focus:outline-none">
                                    Publicar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            @foreach ($publis as $publi)
                <div class="mt-2 mr-2 ml-2">
                    <div class="border-cor border-post-style border-post-w">
                        <div class="ml-2 text-color">
                            <img src="{{ url($u['foto_perfil']) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block mt-2 mb-2">
                            {{$publi->usuario}}
                        </div>
                        <div class="text-xs mb-4 ml-2 mt-1">
                            {{$publi->text}}
                        </div>
                        <div class="bg-gray-100 text-xxs flex pr-2 rounded-sm h-4 text-color">
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
                </div>
            @endforeach
        </div>

        <div class="col-span-1 bg-gray-perfil border-sidebar"></div>
    </div>
@endsection