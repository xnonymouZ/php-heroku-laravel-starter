
<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class LogoutController extends LoginController
{
    protected $redirectAfterLogout = '/b';

        public function logout(Request $request)
        {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect($this->redirectAfterLogout);
        }
}

