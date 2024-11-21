<?php
namespace App\Model\Attribute;

class TextAttribute extends AbstractAttribute {
    public function getAttributeType(): string {
        return 'text';
    }
}