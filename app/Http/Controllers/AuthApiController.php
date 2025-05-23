<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class AuthApiController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_api');
    }

    public function login(Request $request)
    {
        $client = new \GuzzleHttp\Client();

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $serveur = rtrim(env('TOAD_SERVER'), '/');
        $port = env('TOAD_PORT');
        $email = $request->input('email');
        $password = $request->input('password');

        $apiUrl = "http://{$serveur}:{$port}/toad/staff/getByEmail?email=" . urlencode($email);

        try {
            $response = $client->request('GET', $apiUrl);
            $staff = json_decode($response->getBody()->getContents(), true);

            if (!$staff) {
                return back()->with('error', 'Utilisateur non trouvé.');
            }

            if (!isset($staff['pasword']) || $staff['pasword'] !== $password) {
                return back()->with('error', 'Mot de passe incorrect.');
            }

            session([
                'staff_id' => $staff['staffId'],
                'first_name' => $staff['firstName'],
                'last_name' => $staff['lastName'],
                'email' => $staff['email'],
                'store_id' => $staff['storeId'],
                'role_id' => $staff['roleId'],
                'is_logged_in' => true,
            ]);

            return redirect()->route('films.index')->with('success', 'Connexion réussie.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur API : ' . $e->getMessage());
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Déconnecté.');
    }
}
