<?php namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $paginate = Product::paginate(12);
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

        $rootCategories = Category::rootCategories()->get()->sortBy('name');

        $products = $category->products->toArray();

        return view('pages.category.show', compact('category', 'products', 'rootCategories'));
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
