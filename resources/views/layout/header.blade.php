@if (!in_array(Request::url(), [route('login'), route('registro')]))
    <header class="esmeralda p-4 text-white shadow-md">
        <div class="container flex justify-between mx-auto ">
            <div>
                <a href={{route('inicial')}} class="font_header"> EsmeraldaBlog </a>
            </div>

            @if (Auth::check())
                <div x-data="{open: false}" >
                    <button x-on:click="open =! open" class="inline-flex"> 
                        <span class="mr-1 font_header"> 
                            <i class="bi bi-person-circle h-20"></i> {{ $usuario['nome'] }}
                        </span> 
                        <i class="bi bi-caret-down-fill icone_menu"></i>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-20 bg-white rounded-md text-black border border-black">
                        <ul class="py-1 text-sm text-gray-800">
                            <li> 
                                <a href="#" class="mt-1 block px-4 py-1 rounded-sm hover:bg-gray-100"> Perfil </a> 
                            </li>
                            <li> <a href="#" class="block px-4 py-1 rounded-sm hover:bg-gray-100"> Configurações </a></li>
                            <li> <a href="#" class="mb-1 block px-4 py-1 rounded-sm hover:bg-gray-100"> Deslogar </a></li>
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
@endif
