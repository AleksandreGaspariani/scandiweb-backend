<?php
namespace App\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends ObjectType {
    public function __construct() {
        $config = [
            'name' => 'Product',
            'fields' => [
                'id' => Type::nonNull(Type::string()),
                'name' => Type::nonNull(Type::string()),
                'inStock' => Type::nonNull(Type::boolean()),
                'gallery' => Type::listOf(Type::string()),
                'description' => Type::string(),
                'category' => Type::nonNull(Type::string()),
                'attributes' => [
                    'type' => Type::listOf(TypeRegistry::attributeSet()),
                    'resolve' => function($product) {
                        return (new AttributeResolver())->resolveAttributes($product->getId());
                    }
                ],
                'prices' => Type::listOf(TypeRegistry::price()),
                'brand' => Type::string()
            ]
        ];
        
        parent::__construct($config);
    }
}