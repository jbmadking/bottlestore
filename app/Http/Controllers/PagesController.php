<?php namespace App\Http\Controllers;

use App\Repositories\Category;
use App\Repositories\Product;
use App\Http\Requests;
use Illuminate\Http\Response;

class PagesController extends Controller
{

    /**
     * Display a home page
     *
     * @return Response
     */
    public function home()
    {
        $rootCategories = Category::rootCategories()->get()->sortBy('name');
        $paginate = Product::paginate(20);
        $products = $paginate->items();
        $cartTotal = 0;

        return view(
            'pages.index',
            compact(
                'rootCategories',
                'products',
                'paginate',
                'cartTotal'
            )
        );
    }

    /**
     * Show the about us page
     *
     * @return Response
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Show the contact us page
     *
     * @return Response
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Display a Category and its products.
     *
     * @param $slug
     *
     * @return Response
     * @internal param int $id
     *
     */
    public function category($slug)
    {
        $category = Category::findBySlug($slug);
        $paginate = $category->products()->paginate(20);
        $products = $paginate->items();
        $rootCategories = Category::rootCategories()->get()->sortBy('name');

        return view('pages.category.show', compact('category', 'products', 'rootCategories', 'paginate'));
    }

    /**
     * Display product's details page.
     *
     * @param $product
     *
     * @return Response
     */
    public function product($product)
    {
        $categories = Category::get()->sortBy('name');

        $paginate = Product::paginate(6);

        $products = $paginate->items();

        $product = Product::findByName($product)->get()->first();

        return view('product.index', compact('product', 'products', 'categories'));
    }

}
