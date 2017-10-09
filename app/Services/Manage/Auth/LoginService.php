<?php

namespace App\Services\Manage\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\ManagerRepository;
use Illuminate\Support\Facades\Auth;

class LoginService extends Controller
{
    protected $manager;

    public function __construct(ManagerRepository $manager)
    {
        $this->manager = $manager;
    }

    public function login($name, $username, $password)
    {
        $credentials = [
            $name      => $username,
            'password' => $password,
        ];

        if (!Auth::guard('manager')->attempt($credentials)) {
            return false;
        }

        return true;
    }

    public function logout()
    {
        return Auth::guard('manager')->logout();
    }
}
