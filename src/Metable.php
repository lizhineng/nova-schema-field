<?php

namespace Lizhineng\NovaSchemaField;

trait Metable
{
    /**
     * The store of meta data.
     *
     * @var array
     */
    public $meta = [];

    /**
     * Append the meta to the store.
     *
     * @param  array  $meta
     * @return $this
     */
    public function withMeta(array $meta)
    {
        $this->meta = array_merge($this->meta, $meta);

        return $this;
    }

    /**
     * Get the meta data.
     *
     * @return array
     */
    public function meta()
    {
        return $this->meta;
    }
}
