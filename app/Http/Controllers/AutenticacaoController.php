<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AutenticacaoController extends Controller
{
    protected function loginPost (Request $request){
        $request->validate([
            'email' => 'required',
            'senha' => 'required'
        ]);

        $user = User::where("email", $request->email)->first();

        if(!$user){
            return redirect()->intended("login")->with("error", "E-mail inválido.");
        }

        if(password_verify($request->senha, $user->senha)){
            Auth::login($user, true);
            return redirect()->intended(route("inicial"));
        }

        return redirect()->intended(route("login"))->with("error", "Erro no login. Verifique os dados inseridos.");

    }

    protected function registroPost (Request $request){

        $request->validate([
            'nomepessoa' => 'required',
            'sobrenome' => 'required',
            'apelido' => 'required',
            'nascimento' => 'required',
            'email' => 'required',
            'senha' => 'required|min:8',
            'csenha' => 'required|same:senha'
        ], [
            'senha.min' => 'A senha não pode ter menos de 8 caracteres',
            'csenha.same' => 'As senhas não coincidem.',
        ]);

        if(User::where('usuario', $request->apelido)->first()){
            return redirect()->intended(route('registro'))->with('error', 'Apelido de usuário em uso. Tente novamente.');
        }

        if(User::where('email', $request->email)->first()){
            return redirect()->intended(route('registro'))->with('error', 'Email em uso. Tente novamente.');
        }

        $data['nome'] = $request->nomepessoa;
        $data['sobrenome'] = $request->sobrenome;
        $data['usuario'] = $request->apelido;
        $data['email'] = $request->email;
        $data['senha'] = Hash::make($request->senha);

        $user = User::create($data);

        if($user){
            return redirect()->intended(route('login'))->with('sucess', 'O usuário foi registrado com sucesso.');
        }

        return redirect()->intended(route('registro'))->with('error', 'Ocorreu um erro no registro do usuário. Tente novamente.');
    }
}
