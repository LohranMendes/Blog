@extends('layout.master')
@section('titulo', 'Bate-papo com...')

@section('conteudo')
    <div class="grid grid-cols-8">
        <div class="col-span-3">
            <div class="border-homebar h-visor"></div>
        </div>

        <div class="col-span-5 flex items-center justify-center">
                <div class="max-w-lg rounded overflow-hidden shadow-lg">
                    <div class="w-full flex justify-center esmeralda">
                        <span class="text-white font-bold"> Bate-Papo </span>
                    </div>
                    <div id="area_mensagem">
                        
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <textarea class="px-4 pl-2 text-post-1" placeholder="Digite a mensagem aqui"></textarea>
                    </div>
                  </div>
        </div>
    </div>
@endsection