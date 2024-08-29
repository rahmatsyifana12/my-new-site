<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Services\TrelloApiService;

class LoginController extends Controller
{
    protected $trelloApiService;

    public function __construct()
    {
        $this->trelloApiService = new TrelloApiService();
    }

    /**
     * Handle an incoming login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->trelloApiService->getBoards();

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            if ($user->password == $request->input('password')) {
                return redirect()->intended('dashboard');
            }
        }

        return redirect()->route('login')
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput();
    }
}
