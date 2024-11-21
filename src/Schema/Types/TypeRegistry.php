<?php
namespace App\Schema\Types;

class TypeRegistry {
    private static $categoryType;
    private static $productType;
    private static $attributeSetType;
    private static $attributeType;
    private static $priceType;
    
    public static function category() {
        return self::$categoryType ?: (self::$categoryType = new CategoryType());
    }
    
    public static function product() {
        return self::$productType ?: (self::$productType = new ProductType());
    }
    
    // Add other type getters...
}