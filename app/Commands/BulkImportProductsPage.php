<?php namespace App\Commands;

use App\Repositories\Product;
use Illuminate\Contracts\Bus\SelfHandling;
use \Goutte\Client as GoutteClient;
use Illuminate\Http\Request;

class BulkImportProductsPage extends Command implements SelfHandling
{
    const BASE_URL = 'http://www.bottleshop.co.za';
    protected $categories;

    /**
     * Create a new command instance.
     *
     * @param $categories
     */
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Execute the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        $client = new GoutteClient();
        $slug = $request->input('slug');
        $crawler = $client->request('GET', self::BASE_URL . '/' . $slug);
        $products = $this->getProducts($crawler);

        foreach ($products as $product) {

            if ($this->saveProductImage($client, $product['url'], $product['slug'], $product['ext'])) {

                $product = Product::create(
                    [
                        'name' => $product['item'],
                        'image' => $product['slug'] . '.' . $product['ext'],
                        'description' => $product['item'],
                        'price' => $product['price'],
                        'status' => 0,
                        'quantity' => 0,
                    ]
                );

                foreach ($request->input('categories') as $category) {

                    $product->category()->attach($category);
                }
            }

        }
    }

    private function saveProductImage($client, $imageUrl, $slug, $ext)
    {
        $imageName = 'C:\\nginx-1.6.2\\html\\bottlestore\\public\\images\\catalog\\' . $slug . '.' . $ext;

        return $client->getClient()->get(
            $imageUrl, ['save_to' => $imageName,
                'headers' => ['Referer' => 'localhost']
            ]
        );


    }

    /**
     * @param $crawler
     *
     * @return mixed
     */
    private function getProducts($crawler)
    {
        $products = [];
        $counter = 1;

        $crawler->filter('li.Odd > a, li.Even')->each(
            function ($listItemNode) use (&$products, &$counter) {

                $listItemNode->filter('div a img')->each(
                    function ($imageNode) use (&$products, &$counter) {

                        $products[$counter]['image'] = $imageNode->attr('src');

                        list($products[$counter]['url'], $products[$counter]['params']) = explode(
                            '?', $products[$counter]['image']
                        );

                        $pathInfo = pathinfo($products[$counter]['url']);
                        $products[$counter]['ext'] = $pathInfo['extension'];
                    }
                );

                $listItemNode->filter('div strong a')->each(
                    function ($linkNode) use (&$products, &$counter) {

                        $products[$counter]['slug'] = str_replace(
                            "/", '', substr($linkNode->attr('href'), strlen(self::BASE_URL))
                        );

                        $products[$counter]['item'] = $linkNode->text();
                    }
                );

                $listItemNode->filter('div.ProductPriceRating em')->each(
                    function ($emphasisNode) use (&$products, &$counter) {

                        $products[$counter]['price'] = substr($emphasisNode->text(), 1);
                    }
                );

                $counter++;
            }
        );

        return $products;
    }
}
