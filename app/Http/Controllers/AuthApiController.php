<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthApiController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_api');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $response = Http::get(env('API_STAFF_BASE_URL') . '/getByEmail', [
                'email' => $request->email
            ]);

            if ($response->ok()) {
                $staff = $response->json();

                // On utilise 'pasword' à la place de 'password' car l'API a une faute de frappe, que des galères toute façon
                if ($staff && isset($staff['pasword']) && $staff['pasword'] === $request->password) {
                    session([
                        'staff_id' => $staff['staffId'],
                        'staff_name' => $staff['firstName'] . ' ' . $staff['lastName'],
                        'staff_email' => $staff['email'],
                        'staff_role' => $staff['roleId']
                    ]);

                    return redirect()->route('dashboard')->with('success', 'Connecté avec succès');
                } else {
                    return back()->with('error', 'Mot de passe incorrect ou non trouvé');
                }
            } else {
                return back()->with('error', 'Email introuvable');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Déconnecté');
    }
}
