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
        'Escobar@autoprime.com',
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
            return redirect()->route('admin.veiculos.index')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.'
        ])->withInput();
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

    public function editProfile()
    {
        if (!Auth::check() || !in_array(Auth::user()->email, $this->adminEmails)) {
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Acesso negado. Você precisa ser um administrador.'
            ]);
        }

        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->email, $this->adminEmails)) {
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Acesso negado.'
            ]);
        }

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O nome não pode ter mais de 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este email já está em uso',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->email, $this->adminEmails)) {
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Acesso negado.'
            ]);
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'A senha atual é obrigatória',
            'password.required' => 'A nova senha é obrigatória',
            'password.min' => 'A nova senha deve ter pelo menos 6 caracteres',
            'password.confirmed' => 'As senhas não conferem',
        ]);

        $user = Auth::user();

        // Verificar se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'A senha atual está incorreta.'
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Senha alterada com sucesso!');
    }
}
