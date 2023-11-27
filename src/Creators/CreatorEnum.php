<?php

namespace Eghamat24\DatabaseRepository\Creators;

use Illuminate\Support\Collection;
use Eghamat24\DatabaseRepository\Commands\MakeEnum;

class CreatorEnum implements IClassCreator
{
    public function __construct(
        public Collection $columns,
        public            $attributeStub,
        public            $enum,
        public            $enumName,
        public            $enumNamespace
    )
    {

    }

    public function createAttributes(): array
    {
        $attributes = [];
        foreach ($this->enum as $_enum) {
            $attributes[strtoupper($_enum)] = $this->writeAttribute(
                $this->attributeStub,
                strtoupper($_enum),
                $_enum
            );
        }
        return $attributes;
    }

    public function createFunctions(): array
    {
        return [];
    }

    public function createUses(): array
    {
        return [];
    }

    public function getExtendSection(): string
    {
        return '';
    }

    public function getNameSpace(): string
    {
        return $this->enumNamespace;
    }

    public function getClassName(): string
    {
        return $this->enumName;
    }

    private function writeAttribute(string $attributeStub, string $attributeName, string $attributeString): string
    {
        return str_replace(['{{ AttributeName }}', '{{ AttributeString }}'],
            [$attributeName, $attributeString],
            $attributeStub);
    }
}
