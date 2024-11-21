<?php
namespace App\Repository;

use App\Model\Product\AbstractProduct;
use PDO;

class ProductRepository {
    private PDO $connection;
    
    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }
    
    public function getProducts(?string $category = null): array {
        $sql = "SELECT * FROM products";
        if ($category && $category !== 'all') {
            $sql .= " WHERE category = :category";
        }
        
        $stmt = $this->connection->prepare($sql);
        if ($category && $category !== 'all') {
            $stmt->bindParam(':category', $category);
        }
        $stmt->execute();
        
        return array_map([$this, 'createProductFromRow'], $stmt->fetchAll());
    }
    
    private function createProductFromRow(array $row): AbstractProduct {
        $productClass = 'App\\Model\\Product\\' . ucfirst($row['category']) . 'Product';
        $product = new $productClass();
        // Set product properties
        return $product;
    }
}