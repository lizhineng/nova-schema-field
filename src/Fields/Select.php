<?php

namespace Lizhineng\NovaSchemaField\Fields;

class Select extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'select-field';

    /**
     * Set the option list.
     *
     * @param  array  $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->withMeta([
            'options' => collect($options)->map(function ($label, $value) {
                return ['label' => $label, 'value' => $value];
            })->values()->all(),
        ]);

        return $this;
    }

    /**
     * Display using label instead of value.
     *
     * @return $this
     */
    public function displayUsingLabel()
    {
        $this->displayUsing(function ($value) {
            return collect($this->meta['options'])
                ->where('value', $value)
                ->first()['label'] ?? $value;
        });

        return $this;
    }
}
