@extends('layout.master')
@section('titulo', 'Mensagens')
@push('script-js')
<script> var id = {{Auth::id()}}; var u = @json($u); var usuario = @json($user);</script>
@endpush

@section('conteudo')
    <div class="grid grid-cols-8">
        <div class="col-span-3 flex items-center border-homebar h-visor justify-center">
            <div class="max-w-sm min-w-24 overflow-hidden">
                <div class="w-full flex justify-center esmeralda">
                    <span class="text-white font-bold"> Conversas </span>
                </div>
                <div id="area_conversa">
                    <div id="foto_conversa" class="flex items-center justify-center">
                        <div class="text-center">
                            <img id="img_mensagem" src="{{route('imagem', ['usuario' => $u['usuario']])}}" class="h-32 w-32 mb-2">
                            <span class="text-color"> {{$u->usuario}} </span>
                            <div class="flex justify-between">
                                <a href="{{route('perfil', ['usuario' => $u->usuario])}}">
                                    <button type="button" class="bg-yellow-300 px-2 py-1 hover:bg-yellow-400 rounded-md">
                                        <span> Perfil </span>
                                    </button>
                                </a>
                                <a href="{{route('inicial')}}">
                                    <button type="button" class="bg-red-500 px-2 py-1 hover:bg-red-600 rounded-md">
                                        Fechar
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="border border-cor">
                </div>
            </div>
        </div>

        <div class="col-span-5 flex items-center justify-center">
            <div class="max-w-lg min-w-32 rounded overflow-hidden shadow-lg">
                <div class="w-full flex justify-center esmeralda">
                    <span class="text-white font-bold"> Bate-Papo com {{$u->usuario}} </span>
                </div>
                <div id="area_mensagem"></div>
                <hr class="border-cor">
                <form id="form_msg" method="POST">
                    @csrf
                    <div class="px-3 py-2">
                        <div class="inline-flex w-full items-center">
                            <textarea id="input_msg" class="w-full text-post-1" placeholder="Digite a mensagem aqui"></textarea>
                            <button type="submit" class="border border-cor mx-auto p-3 esmeralda">
                                <i class="bi bi-send-fill text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module" src="{{ asset('js/websocket.js')}}"></script>
        <script src="{{ asset('js/gerais.js')}}"></script>
        <script src="{{ asset('js/modal.js') }}"></script> 
        <script type="module" src="{{ asset('js/mensagens.js')}}"></script> 
    @endpush
@endsection
