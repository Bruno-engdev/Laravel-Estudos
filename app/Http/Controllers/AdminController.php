<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminEmails = [
        'admin@autoprime.com',
        'bruno@autoprime.com',
        'gerente@autoprime.com',
        'supervisor@autoprime.com'
    ];

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres'
        ]);

        if (!in_array($request->email, $this->adminEmails)) {
            return back()->withErrors([
                'email' => 'Este email não possui permissão de administrador.'
            ])->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Credenciais inválidas.'
            ])->withInput();
        }

        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.'
        ])->withInput();
    }

    public function dashboard()
    {
        if (!Auth::check() || !in_array(Auth::user()->email, $this->adminEmails)) {
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Acesso negado. Você precisa ser um administrador.'
            ]);
        }

        $totalVeiculos = Veiculo::count();
        $veiculosAtivos = Veiculo::where('status', 'ativo')->count();
        $totalClientes = User::count();
        $veiculosRecentes = Veiculo::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalVeiculos',
            'veiculosAtivos', 
            'totalClientes',
            'veiculosRecentes'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logout realizado com sucesso!');
    }

    public function isAdmin($email = null)
    {
        $emailToCheck = $email ?: (Auth::check() ? Auth::user()->email : null);
        return $emailToCheck && in_array($emailToCheck, $this->adminEmails);
    }
}
