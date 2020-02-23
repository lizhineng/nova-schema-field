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
     * The fields of the schema.
     *
     * @var array
     */
    public $fields = [];

    /**
     * The label that should be used for the add row button.
     *
     * @var string
     */
    public $addText;

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

    /**
     * Set the fields displayed by the schema field.
     *
     * @param  array  $fields
     * @return $this
     */
    public function fields($fields)
    {
        $this->fields = $fields;

        return $this;
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
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'fields' => $this->fields,
            'addText' => $this->addText ?? __('Add row'),
        ]);
    }
}
