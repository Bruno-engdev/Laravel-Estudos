<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Exibe a página de login
     */
    public function showLoginForm()
    {
        return view('cliente.Login');
    }

    /**
     * Exibe a página de cadastro
     */
    public function showRegisterForm()
    {
        return view('cliente.Cadastro');
    }

    /**
     * Processa o login do usuário
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Redireciona para o dashboard do cliente
            return redirect()->route('cliente.dashboard')->with('success', 'Login realizado com sucesso!');
        }

        return redirect()->back()
            ->withErrors(['email' => 'As credenciais fornecidas não correspondem aos nossos registros.'])
            ->withInput($request->except('password'));
    }

    /**
     * Processa o cadastro do usuário
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted',
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.unique' => 'Este email já está em uso.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'terms.required' => 'Você deve aceitar os termos de uso.',
            'terms.accepted' => 'Você deve aceitar os termos de uso.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Limpa o CPF removendo caracteres especiais
        $cpf = preg_replace('/\D/', '', $request->cpf);
        
        // Limpa o telefone removendo caracteres especiais
        $phone = preg_replace('/\D/', '', $request->phone);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'cpf' => $cpf,
            'password' => Hash::make($request->password),
        ]);

        // Faz login automático após o cadastro
        Auth::login($user);

        return redirect()->route('cliente.dashboard')->with('success', 'Cadastro realizado com sucesso! Bem-vindo!');
    }

    /**
     * Faz logout do usuário
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('cliente.home')->with('success', 'Você saiu da sua conta.');
    }

    /**
     * Dashboard do cliente (NÃO É ADMIN)
     */
    public function dashboard()
    {
        // Retorna o dashboard do CLIENTE, não do admin
        return view('cliente.dashboard');
    }
}