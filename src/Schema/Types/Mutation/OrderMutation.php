<?php
namespace App\Schema\Mutation;

use GraphQL\Type\Definition\Type;

class OrderMutation {
    public static function getFields() {
        return [
            'createOrder' => [
                'type' => Type::string(),
                'args' => [
                    'products' => Type::nonNull(Type::listOf(Type::string())),
                    'email' => Type::nonNull(Type::string())
                ],
                'resolve' => function($root, $args) {
                    // Implement order creation logic
                    return "Order created successfully";
                }
            ]
        ];
    }
}