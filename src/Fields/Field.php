<?php

namespace Lizhineng\NovaSchemaField\Fields;

use JsonSerializable;
use Illuminate\Support\Str;
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
     * The field's value.
     *
     * @var string
     */
    public $value;

    /**
     * Customize the value for display.
     *
     * @var callable|null
     */
    public $displayCallback;

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
    public function __construct($name, $attribute = null)
    {
        $this->name = $name;
        $this->attribute = $attribute ?? str_replace(' ', '_', Str::lower($name));
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
     * Customize the value for display.
     *
     * @param callable $callback
     * @return $this
     */
    public function displayUsing(callable $callback)
    {
        $this->displayCallback = $callback;

        return $this;
    }

    /**
     * Resolve the value.
     *
     * @param $resource
     * @return void
     */
    public function resolve($resource)
    {
        $this->value = $resource[$this->attribute];
    }

    /**
     * Resolve the value for display.
     *
     * @param $resource
     * @return void
     */
    public function resolveForDisplay($resource)
    {
        if (is_callable($this->displayCallback)) {
            $this->value = call_user_func($this->displayCallback, $resource[$this->attribute]);
        } else {
            $this->value = $resource[$this->attribute];
        }
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
            'value' => $this->value,
        ], $this->meta());
    }
}
