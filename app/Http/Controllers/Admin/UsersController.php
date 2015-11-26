<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\AdminRegistrar as Registrar;
use Illuminate\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Response;

class UsersController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    /**
     * @var string
     */
    protected $loginPath = 'admin/login';

    /**
     * @var string
     */
    protected $redirectAfterLogout = 'admin/login';

    /**
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';


    /**
     * Create a new authentication controller instance.
     *
     * @param  $auth
     * @param  $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('admin.register');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * Show User Dashboard.
     *
     * @return Response
     */
    public function getDashboard()
    {
        if (!$this->auth->user()->is_admin) {

            flash('Restricted Access!!!');

            return redirect('user/dashboard');
        }

        return view('admin.dashboard');
    }

}












