@extends('layout.master')
@section('titulo', 'Página Inicial')
@push('script-js')
    <script src="{{ asset('js/modal.js') }}"></script> 
@endpush

@section('conteudo')
    <div class="grid grid-cols-10 gap-0">
        <div class="col-span-2 p-4 border-homebar">
            <div class="inline-flex">
                <div class="mb-2 mr-2">
                    @if($user->foto_perfil == 'img/foto-de-perfil-de-usuario.jpg')
                        <img src="{{ url($user->foto_perfil) }}" alt="Foto do Perfil" class="h-10 w-10 inline-block">
                    @else
                        <img src="{{ route('imagem', ['usuario' => $user->usuario]) }}" alt="Foto do Perfil" class="h-12 w-12 inline-block">
                    @endif 
                </div>
            
                <div>
                    <div>
                        <span>{{ $user['usuario'] }}</span>
                    </div>
                    <button type="button" onclick="mostrarModal()" class="text-color">
                        Editar Perfil
                    </button>
                </div>
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
                <form id="formPubli" method="POST">
                    @csrf
                    <div class="border-cor border-post-style border-post-w ">
                        <label for="publi" class="text-form-post  mb-1 pl-2"> Crie um novo tópico! </label>
                        <hr class="w-full border-cor mb-2">
                        <textarea id="publi" name="publi" class="block text-sm pb-5 px-2 w-full rounded-md text-post-1" placeholder="Digite aqui"></textarea>
                        <div class="bg-gray-100 flex justify-end pr-2 rounded-sm">
                            <button type="submit" id="publiPost" class="btn-cor btn-font-size text-white p-1 my-2 rounded-md focus:outline-none">
                                Publicar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="publicacoes">
                
            </div>
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

    @push('modal_um')
        <div id="perfil-modal" tabindex="-1" class="hidden fixed inset-0 items-center justify-center h-screen bg-opacity-50">
            <div class="fixed inset-0 bg-gray-800 bg-opacity-50"></div>
            <div class="relative p-4 w-1/2">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" onclick="fecharModal()" class="absolute top-3 end-2.5 text-red-500 bg-transparent right-0 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Fechar Modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <h3 class="mb-5 text-lg font-normal text-gray-800 dark:text-gray-400">Editar Perfil</h3>
                        <form action="{{route('editar', ['usuario' => $user['usuario']])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex">
                                <div class="mb-4 mt-5 flex items-center w-1/2">
                                    <label for="nomeUsuario" class="inline-block text-sm font-medium mr-2 text-gray-600 dark:text-gray-300 w-14/100">Nome:</label>
                                    <input type="text" id="nomeUsuario" name="nomeUsuario" class="block mr-2 fs-sml pl-1 p-1 text-gray-900 rounded-md w-3/4 hover:bg-gray-50 border border-black" placeholder="{{$user['nome']}}" autocomplete="off">
                                </div>
                                <div class="mb-4 mt-5 flex items-center w-1/2">
                                    <label for="sobrenomeUsuario" class="inline-block mr-10 text-sm font-medium text-gray-600 dark:text-gray-300 w-14/100">Sobrenome:</label>
                                    <input type="text" id="sobrenomeUsuario" name="sobrenomeUsuario" class="block fs-sml pl-1 p-1 text-gray-900 rounded-md w-3/4 hover:bg-gray-50 border border-black" placeholder="{{$user['sobrenome']}}" autocomplete="off">
                                </div>
                            </div>
                                <div class="mb-4 flex items-center w-full">
                                    <label for="foto_perfil" class="inline-block text-sm font-medium mr-2 text-gray-600 dark:text-gray-300 w-14/100">Foto de Perfil:</label>
                                    <input type="file" id="foto_perfil" name="foto_perfil" class="block fs-sml  pl-1 p-1 w-85/100 border border-black rounded-md">
                                </div>
                                <div class="mb-4 flex items-center w-full">
                                    <label for="capa_perfil" class="inline-block text-sm font-medium mr-1 text-gray-600 dark:text-gray-300 w-15/100">Capa de Perfil:</label>
                                    <input type="file" id="capa_perfil" name="capa_perfil" class="fs-sml pl-1 p-1 block w-85/100 border border-black rounded-md">
                                </div>
                            </div>
                            <div class="flex justify-end mr-2">
                                <button onclick="fecharModal()" name="pi" data-modal-hide="perfil-modal" type="submit" class="text-white mb-2 btn-cor hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="{{ asset('js/modal.js') }}"></script> 
        <script> var publicacoes = @json($publis); var usuario = @json($user)</script>
        <script src="{{ asset('js/publicacoes.js') }}"></script> 
    @endpush
@endsection
