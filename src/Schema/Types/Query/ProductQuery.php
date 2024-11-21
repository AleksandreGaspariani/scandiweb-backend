<?php
namespace App\Schema\Query;

use App\Schema\Types\TypeRegistry;
use GraphQL\Type\Definition\Type;

class ProductQuery {
    public static function getFields() {
        return [
            'products' => [
                'type' => Type::listOf(TypeRegistry::product()),
                'args' => [
                    'category' => ['type' => Type::string()]
                ],
                'resolve' => function($root, $args) {
                    $repository = new ProductRepository();
                    return $repository->getProducts($args['category'] ?? null);
                }
            ]
        ];
    }
}