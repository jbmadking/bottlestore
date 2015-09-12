<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Repositories\Category;
use App\Repositories\Product;
use Illuminate\Http\Response;

class ProductsController extends Controller
{

    /**
     * Applies admin wide restrictions
     */
    use AdminControllerTrait;

    /**
     * Display Products list.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show new Product Form
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store Product.
     *
     * @param ProductRequest $request
     *
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product($request->all());

        $product->save();

        $product->category()->attach($request->get('category'));

        flash()->message(
            sprintf(
                'New Product: %s Created',
                $request->get('name')
            )
        );

        return redirect('/admin/products');
    }

    /**
     * Display Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show Product Edit Form.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::lists('name', 'id');

        $categories[0] = 'None';

        ksort($categories);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update Product.
     *
     * @param ProductRequest $request
     *
     * @return Response
     *
     */
    public function update(ProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);
        $data = $request->all();
        $uploadFile = $request->file('image');

        $imageName = sprintf(
            '%s-%s', $product->id, $uploadFile->getClientOriginalName()
        );

        $filePath = base_path() . '/public/images/catalog/';

        if (!file_exists($filePath . $imageName)) {
            $request->file('image')->move($filePath, $imageName);
        }

        $data['image'] = $imageName;

        $product->update($data);

        flash('Product Updated');

        return redirect('/admin/products');
    }

    /**
     * Delete Product.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->destroy();
    }

}
