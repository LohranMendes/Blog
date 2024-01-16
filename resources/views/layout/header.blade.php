@if (!in_array(Request::url(), [route('login'), route('registro')]))
    <nav>
        <header class="esmeralda p-4 text-white shadow-md">
            <div class="container flex flex-wrap justify-between mx-auto ">
                <a href={{route('inicial')}} class="inline-block">
                    <div class="flex items-center">
                        <img src="{{ asset('img/esmeralda_logo.png') }}" style="margin-right: 10px;" alt="EsmeraldaBlog Logo">
                        <span class="font_header">EsmeraldaBlog</span>
                    </div>
                </a>

                @if (Auth::check())
                    <div x-data="{open: false}" class="lg:inline hidden">
                        <button x-on:click="open =! open" class="inline-flex"> 
                            <span class="mr-1 font_header"> 
                                @if($user->foto_perfil == 'img/foto-de-perfil-de-usuario.jpg')
                                    <img src="{{ url($user->foto_perfil) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block">
                                @else
                                    <img src="{{ route('imagem', ['usuario' => $user->usuario]) }}" alt="Foto do Perfil" class="h-8 w-8 inline-block">
                                @endif 
                                {{ $user->usuario }}
                            </span> 
                            <i class="bi bi-caret-down-fill icone_menu"></i>
                        </button>

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
