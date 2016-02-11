<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make(
          $data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
          ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        return User::create(
          [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_admin' => true
          ]
        );
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
        if (!Auth::user()->is_admin) {

            flash('Restricted Access!!!');

            return redirect('user/dashboard');
        }

        return view('admin.dashboard');
    }

}












