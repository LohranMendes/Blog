@if (!in_array(Request::url(), [route('login'), route('registro')]))
    <nav>
        <header class="esmeralda p-4 text-white shadow-md">
            <div class="container flex flex-wrap justify-between mx-auto ">
                <div class="flex items-center">
                    <a href={{route('inicial')}} class="inline-flex">
                        <img src="{{ asset('img/esmeralda_logo.png') }}" style="margin-right: 10px;" alt="EsmeraldaBlog Logo">
                        <span class="font_header">EsmeraldaBlog</span>
                    </a>
                </div>

                @if (Auth::check())
                    <div x-data="{open: false}" class="lg:inline hidden">
                        <div class="inline-flex items-center">
                            <div class="bg-white mr-2 mx-auto my-auto">
                                <input type="text" id="pesquisa" class="pl-1 pesquisa" placeholder="Pesquise aqui">
                                <i class="bi bi-search text-color mr-2"></i>
                            </div>
                            <div id="menu_search">
                            </div>
                            <span class="mr-1 font_header">
                                <a href="{{route('perfil', ['usuario' => $user->usuario])}}">
                                    @if($user->foto_perfil == 'img/foto-de-perfil-de-usuario.jpg')
                                        <img src="{{ url($user->foto_perfil) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block">
                                    @else
                                        <img src="{{ route('imagem', ['usuario' => $user->usuario]) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block">
                                    @endif
                                    {{ $user->usuario }}
                                </a>
                            </span>
                            <button x-on:click="open =! open">
                                <i class="bi bi-caret-down-fill icone_menu"></i>
                            </button>
                        </div>

                        <div x-show="open" @click.away="open = false" class="absolute z-10 right-12 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-1 text-sm text-gray-800">
                                <li> 
                                    <a href="{{route('perfil', ['usuario' => $user->usuario])}}" class="mt-1 block px-4 py-1 rounded-sm hover:bg-gray-100"> Perfil </a> 
                                </li>
                                <li> <a href="#" class="block px-4 py-1 rounded-sm hover:bg-gray-100"> Configurações </a></li>
                                <li> <a href="{{route('deslogar')}}" class="mb-1 block px-4 py-1 rounded-sm hover:bg-gray-100"> Deslogar </a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:hidden" x-data="{sidebar: false}">
                        <button x-on:click="sidebar =! sidebar">
                            <i class="bi bi-list icone_menu_2"></i>
                        </button>

                        <div x-show="sidebar" @click.away="siderbar = false" class="g:hidden fixed esmeralda inset-0 z-index-1 bg-opacity-85">
                            <ul class="py-1 text-sm text-white">
                                <div class="container mt-5">
                                    <div class="flex justify-end">
                                        <button x-on:click="sidebar = false" class="fixed">
                                            <i class="bi bi-x h-12 w-12"></i>
                                        </button>
                                    </div>
                                </div>
                                <li> 
                                    <div class="inline-flex ml-3">
                                        <div class="border border-white mr-2 mx-auto my-auto">
                                            <input type="text" id="search" class="pl-1 pesquisa" placeholder="Pesquise aqui">
                                            <button type="submit" class="border-white mr-1 border-pesquisa">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="menu_search" class="absolute">
                                    </div>
                                <li> 
                                    <a href="{{route('inicial')}}" class="mt-1 block px-4 py-1 rounded-sm hover:bg-gray-800"> Inicial </a> 
                                </li>
                                <li> 
                                    <a href="{{route('perfil', ['usuario' => $user->usuario])}}" class="mt-1 block px-4 py-1 rounded-sm hover:bg-gray-800"> Perfil </a> 
                                </li>
                                <li> 
                                    <a href="#" class="block px-4 py-1 rounded-sm hover:bg-gray-800"> Configurações </a>
                                </li>
                                <li> 
                                    <a href="{{route('deslogar')}}" class="mb-1 block px-4 py-1 rounded-sm hover:bg-gray-800"> Deslogar </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div>
                        <a href="{{route('login')}}" class="font_header"> Login </a>
                    </div>
                @endif
            </div>
        </header>
    </nav>
@endif


