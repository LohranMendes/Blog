@extends('layout.master')
@section('titulo', 'Mensagens')
@push('script-js')
<script> var id = {{Auth::id()}}; var u = @json($u); </script>
@endpush

@section('conteudo')
    <div class="grid grid-cols-8">
        <div class="col-span-3">
            <div class="border-homebar h-visor"></div>
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
