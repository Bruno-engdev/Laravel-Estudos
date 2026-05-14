<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.veiculos.index');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! $user->isAdmin() || ! Hash::check($data['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Credenciais inválidas ou usuário sem permissão de administrador.',
            ])->withInput($request->except('password'));
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->route('admin.veiculos.index')
            ->with('success', 'Login realizado com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logout realizado com sucesso!');
    }

    public function isAdmin(?string $email = null): bool
    {
        if ($email !== null) {
            $user = User::where('email', $email)->first();
            return $user ? $user->isAdmin() : false;
        }

        return Auth::check() && Auth::user()->isAdmin();
    }

    public function editProfile()
    {
        return view('admin.profile.edit', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O nome não pode ter mais de 255 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este email já está em uso',
        ]);

        $user->update($data);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Perfil atualizado com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'A senha atual é obrigatória',
            'password.required' => 'A nova senha é obrigatória',
            'password.min' => 'A nova senha deve ter pelo menos 6 caracteres',
            'password.confirmed' => 'As senhas não conferem',
        ]);

        $user = Auth::user();

        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'A senha atual está incorreta.',
            ]);
        }

        $user->password = $data['password']; // cast 'hashed' faz o hash automaticamente
        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Senha alterada com sucesso!');
    }
}
