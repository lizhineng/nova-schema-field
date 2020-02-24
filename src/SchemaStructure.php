<?php

namespace Lizhineng\NovaSchemaField;

abstract class SchemaStructure
{
    /**
     * Defines the fields for the schema.
     *
     * @return array
     */
    abstract public function fields();
}
