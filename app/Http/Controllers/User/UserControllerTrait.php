<?php

namespace app\Http\Controllers\User;


trait UserControllerTrait
{
    /**
     * The Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}