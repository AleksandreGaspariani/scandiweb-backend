<?php
namespace App\Schema\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType extends ObjectType {
    public function __construct() {
        $config = [
            'name' => 'Category',
            'fields' => [
                'name' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'The name of the category'
                ]
            ]
        ];
        
        parent::__construct($config);
    }
}