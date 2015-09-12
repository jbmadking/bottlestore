<?php namespace App\Http\Controllers\Admin;

use App\Commands\BulkImportProductsPage;
use App\Repositories\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::lists('name', 'id');

        return view('admin.import.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function run(Request $request)
    {

        $this->dispatch(new BulkImportProductsPage($request->only(['categories', 'title'])));
        $request->get('categories');
    }
}
