<?php

namespace app\Http\Controllers\Admin;


trait AdminControllerTrait
{
    /**
     * The Constructor
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
}