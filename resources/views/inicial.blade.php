@extends('layout.master')
@section('titulo', 'Página Inicial')

@section('conteudo')
<div class="grid grid-cols-10 gap-0">
    <div class="col-span-2 p-4 border-homebar">
        <div class="mb-2">
            FOTO
        </div>
    
        <div>
            <div class="inline">
                <span>{{ $user['usuario'] }}</span>
            </div>
            <span>Editar Perfil</span>
        </div>
        
            <div class="mt-5">
                <span>Feed</span>
            </div>
        
            <div class="mt-2">
                <span>Mensagens</span>
            </div>
    </div>

    <div class="col-span-6 p-4">
        <div>
            <form action={{route('pp')}} method="POST">
                @csrf
                <div class="border-cor border-post-style border-post-w ">
                    <label for="publi" class="text-form-post  mb-1 pl-2"> Crie um novo tópico! </label>
                    <hr class="w-full border-cor mb-2">
                    <textarea id="publi" name="publi" class="block text-sm pb-5 px-2 w-full rounded-md text-post-1" placeholder="Digite aqui"></textarea>
                    <div class="bg-gray-100 flex justify-end pr-2 rounded-sm">
                        <button type="submit" class="btn-cor btn-font-size text-white p-1 my-2 rounded-md focus:outline-none">
                            Publicar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @foreach ($publis as $publi)
            <div class="mt-2">
                <div class="border-cor border-post-style border-post-w">
                    <div class="ml-2">
                        <img src="{{ url($user->foto_perfil) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block">
                        <a href={{route('perfil', ['usuario' => $publi->usuario])}} class="text-color">
                            {{$publi->usuario}}
                        </a>
                    </div>
                    <div class="text-xs mb-4 ml-2 mt-1">
                        {{$publi->text}}
                    </div>
                    <div class="bg-gray-100 text-xxs flex pr-2 rounded-sm h-4 text-color ml-2">
                        <span class="mr-2">
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

    <aside class="border-sidebar h-visor col-span-2 w-full p-4">
        <div>
            <ul>
                <li>
                    <span class="">Usuario 2</span>
                </li>
                <li> 
                    <span class="">Usuario 3</span>
                </li>
            </ul>
        </div>
    </aside>
</div>
@endsection
