<?php
namespace App\Model\Attribute;

use App\Model\AbstractModel;

abstract class AbstractAttribute extends AbstractModel {
    protected string $displayValue;
    protected string $value;
    protected string $name;
    
    abstract public function getAttributeType(): string;
}