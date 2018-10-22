<?php
namespace agilman\a2\controller;
use agilman\a2\view\View;
use agilman\a2\model\ProductsCollectionModel;

/**
 * Class HomeController
 *
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class SearchController extends Controller
{
    /**
     * Account Index action
     */
    public function indexAction()
    {
        $view = new View('searchPage');
        echo $view->render();
    }

    public function searchAction()
    {
        // get the q parameter from URL
        $q = $_REQUEST["q"];

        $search = new ProductsCollectionModel();
        $products = $search->getProducts($q);
        echo"<table class=\"table table-striped\">
        <tr>
            <th>ID</th>
            <th>SKU</th>
            <th>Name</th>
            <th>Category</th>
            <th>Cost</th>
            <th>Stock Quantity</th>
        </tr>";
        foreach ($products as $product){
            if($product != null) {
                echo "<tr><td>" . $product['id'] . "</td>
                     <td>" . $product['sku'] . "</td>
                     <td>" . $product['name'] . "</td>
                     <td>" . $product['category'] . "</td>
                     <td>" . $product['cost'] . "</td>
                     <td>" . $product['stock_quantity'] . "</td>
                     </tr>";
            }
        }
        echo "</table>";
    }
}
