<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;


class ClientsController extends Controller
{

    /**
     * Applies admin wide restrictions
     */
    use AdminControllerTrait;

    /**
     * Display Clients List.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::isClient()->get();

        return view('admin.clients.index', compact('users'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit($clientId)
    {
        $client = User::findOrFail($clientId);

        return view('admin.clients.edit', compact('client'));
    }
}