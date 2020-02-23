<?php

namespace Lizhineng\NovaSchemaField\Fields;

use JsonSerializable;
use Lizhineng\NovaSchemaField\Metable;

abstract class Field implements JsonSerializable
{
    use Metable;

    /**
     * The label to display the field.
     *
     * @var string
     */
    public $name;

    /**
     * The attribute of the field.
     *
     * @var string
     */
    public $attribute;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component;

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string  $attribute
     */
    public function __construct($name, $attribute)
    {
        $this->name = $name;
        $this->attribute = $attribute;
    }

    /**
     * Create a new field.
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * Prepares the data for field.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge([
            'name' => $this->name,
            'attribute' => $this->attribute,
            'component' => $this->component,
        ], $this->meta());
    }
}
