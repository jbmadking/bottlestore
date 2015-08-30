<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class AdminUsersController extends Controller
{
    /**
     * Applies admin wide restrictions
     */
    use AdminControllerTrait;

    /**
     * Display Administrators List.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::isAdmin()->get();

        return view('admin.users.index', compact('users'));
    }
}