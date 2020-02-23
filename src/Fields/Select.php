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
        $this->withMeta(['options' => $options]);

        return $this;
    }
}
