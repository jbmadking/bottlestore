<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{

    /**
     * Applies admin wide restrictions
     */
    use AdminControllerTrait;

    /**
     * Display Categories List.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show New Category Form.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->toArray();

        $categories[0] = 'None';

        ksort($categories);

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store Category.
     *
     * @param CategoryRequest $request
     *
     * @return Response
     */
    public function store(CategoryRequest $request)
    {

        Category::create($request->all());

        flash()->message(
          sprintf(
            'New Category: %s Created',
            $request->get('name')
          )
        );

        return redirect('admin/categories');
    }

    /**
     * Display Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return view('admin.categories.show');
    }

    /**
     * Show Category Edit Form.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::where('id', '<>', $id)
          ->lists('name', 'id')
          ->toArray();

        $categories[0] = 'None';

        ksort($categories);

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update Category.
     *
     * @param CategoryRequest $request
     *
     * @param integer         $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $category = Category::findOrFail($id);

        $data = $request->all();
        $data['slug'] = $data['name'];

        $category->update($data);

        flash()->message(
          sprintf(
            'Category: %s Updated',
            $category->name
          )
        );

        return redirect('admin/categories');
    }

    /**
     * Delete Category.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
