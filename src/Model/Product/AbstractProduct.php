<?php
namespace App\Model\Product;

use App\Model\AbstractModel;

abstract class AbstractProduct extends AbstractModel {
    protected string $name;
    protected bool $inStock;
    protected array $gallery;
    protected string $description;
    protected string $category;
    protected array $attributes;
    protected array $prices;
    protected string $brand;
    
    public function getName(): string {
        return $this->name;
    }
    
    // Add other getters/setters...
    
    abstract public function getType(): string;
}