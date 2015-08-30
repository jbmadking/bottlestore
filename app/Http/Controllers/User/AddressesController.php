<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class AddressesController
 *
 * @package App\Http\Controllers\User
 */
class AddressesController extends Controller
{

    /**
     * Applies user wide restrictions
     */
    use UserControllerTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $addresses = Auth::user()->addresses;

        return view('users.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddressRequest $request
     *
     * @return Response
     */
    public function store(AddressRequest $request)
    {

        Auth::user()->addresses()->create($request->all());

        flash()->message('New Address Saved');

        return redirect('/user/addresses');
    }

}
