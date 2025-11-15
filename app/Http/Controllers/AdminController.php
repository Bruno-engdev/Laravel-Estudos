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
        'admin@gmail.com',
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

        // Estatísticas para os cards
        $totalVeiculos = Veiculo::count();
        $veiculosAtivos = Veiculo::where('status', 'Disponível')->count();
        $totalClientes = User::whereNotIn('email', $this->adminEmails)->count(); // Excluir admins da contagem
        
        // Veículos recentes para visualização rápida
        $veiculosRecentes = Veiculo::with(['marca', 'modelo', 'cor'])
            ->latest()
            ->take(5)
            ->get();
        
        // IMPORTANTE: Todos os veículos com relacionamentos carregados
        $todosVeiculos = Veiculo::with(['marca', 'modelo', 'cor'])
            ->orderBy('created_at', 'desc')
            ->get();

        // NOVO: Todos os clientes (excluindo admins)
        $todosClientes = User::whereNotIn('email', $this->adminEmails)
            ->orderBy('created_at', 'desc')
            ->get();

        // Clientes recentes
        $clientesRecentes = User::whereNotIn('email', $this->adminEmails)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVeiculos',
            'veiculosAtivos', 
            'totalClientes',
            'veiculosRecentes',
            'todosVeiculos',
            'todosClientes',
            'clientesRecentes'
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
