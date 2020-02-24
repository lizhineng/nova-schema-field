<?php

namespace Lizhineng\NovaSchemaField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class Schema extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'schema-field';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * The class of the schema structure.
     *
     * @var string
     */
    protected $structureClass;

    /**
     * The data for the field.
     *
     * @var array
     */
    protected $data;

    /**
     * The label that should be used for the add row button.
     *
     * @var string
     */
    protected $actionText;

    public function __construct($name, $attribute = null, $structure)
    {
        parent::__construct($name, $attribute);

        $this->structureClass = $structure;
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists($requestAttribute)) {
            $model->{$attribute} = json_decode($request[$requestAttribute], true);
        }
    }

    public function resolveForDisplay($resource, $attribute = null)
    {
        parent::resolveForDisplay($resource, $attribute);

        $this->data = collect($this->value)->map(function ($item) {
            return tap($this->structure()->fields(), function ($fields) use ($item) {
                collect($fields)->map->resolveForDisplay($item);
            });
        });
    }

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        $this->data = collect($this->value)->map(function ($item) {
            return tap($this->structure()->fields(), function ($fields) use ($item) {
                collect($fields)->map->resolve($item);
            });
        });
    }

    /**
     * The label that should be used for the add row button.
     *
     * @param  string  $label
     * @return $this
     */
    public function addText($label)
    {
        $this->addText = $label;

        return $this;
    }

    /**
     * Create a new schema structure.
     *
     * @return SchemaStructure
     */
    protected function structure()
    {
        return new $this->structureClass;
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'fields' => $this->structure()->fields(),
            'data' => $this->data,
            'actionText' => $this->actionText ?? __('Add row'),
        ]);
    }
}
