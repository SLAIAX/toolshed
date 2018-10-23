<?php
namespace agilman\a2\model;
use agilman\a2\model\ProductsModel;


/**
 * Class ProductsCollectionModel
 * @package agilman\a2\model
 */
class ProductsCollectionModel extends Model
{
    /**
     * @var an array of IDs that for each product
     */
    private $accountIds;

    /**
     * @return the
     */
    public function getN()
    {
        return $this->N;
    }

    /**
     * @var the number products
     */
    private $N;

    /**
     * ProductsCollectionModel constructor.
     */
    public function __construct($str)
    {
        parent::__construct();
        if (!$result = $this->db->query("SELECT `id` FROM `products` WHERE `sku` LIKE '%$str%' OR `name` LIKE '%$str%' OR `category` LIKE '%$str%';")) {
            throw new \mysqli_sql_exception();
        }
        $this->accountIds = array_column($result->fetch_all(), 0);
        $this->N = $result->num_rows;
    }


    /**

     * @param $str
     * @return \Generator
     * Calls the search product query on every ID
     */
    public function getProducts($str)
    {
        foreach ($this->accountIds as $id) {
            // Use a generator to save on memory/resources
            // load accounts from DB one at a time only when required
            yield (new ProductsModel())->searchProducts($str, $id);
        }
    }
}
