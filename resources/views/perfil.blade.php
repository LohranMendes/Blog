@extends('layout.master')
@section('titulo', 'Página Inicial')

@section('conteudo')
    <div class=" h-visor grid grid-cols-8">
        <div class="col-span-1 bg-gray-perfil border-homebar"></div>

        <div class="col-span-6">
            <div class="bg-gray-800 h-banner-perfil relative flex items-center text-2xl">
                <div class="w-full">
                    <div class="h-20 w-20 absolute bottom-5 left-8 border-cor border-w inline-flex items-center text-white ">
                        <img src="{{($usuario['foto_perfil']) }}" alt="Foto do Perfil">
                        <span class="pl-2"> {{$usuario['nome']}} </span>
                        <span class="pl-2"> {{$usuario['sobrenome']}} </span>
                    </div>
                    <div class="justify-end">
                        <a href="#">
                            
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-1 bg-gray-perfil border-sidebar"></div>
    </div>
@endsection