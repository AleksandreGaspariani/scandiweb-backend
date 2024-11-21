<?php
namespace App\Controller;

use GraphQL\GraphQL as GraphQLBase;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use GraphQL\Type\Definition\ObjectType;
use App\Schema\Query\ProductQuery;
use App\Schema\Mutation\OrderMutation;

class GraphQL {
    public static function handle() {
        try {
            $queryType = new ObjectType([
                'name' => 'Query',
                'fields' => array_merge(
                    ProductQuery::getFields()
                )
            ]);
            
            $mutationType = new ObjectType([
                'name' => 'Mutation',
                'fields' => array_merge(
                    OrderMutation::getFields()
                )
            ]);
            
            $schema = new Schema(
                (new SchemaConfig())
                    ->setQuery($queryType)
                    ->setMutation($mutationType)
            );
            
            $rawInput = file_get_contents('php://input');
            if ($rawInput === false) {
                throw new \RuntimeException('Failed to get php://input');
            }
            
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;
            
            $result = GraphQLBase::executeQuery($schema, $query, null, null, $variableValues);
            $output = $result->toArray();
            
        } catch (\Throwable $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage()
                ]
            ];
        }
        
        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($output);
    }
}