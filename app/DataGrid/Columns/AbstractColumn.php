<?php

namespace App\DataGrid\Columns;

use App\DataGrid\Contracts\Column as ColumnContract;

class AbstractColumn implements ColumnContract
{
    /**
     * Column Identifier
     */
    protected $identifier = NULL;

    /**
     * Column Label
     */
    protected $label = NULL;

    /**
     * Is Column Sortable?
     */
    protected $sortable = NULL;

    public function __construct($identifier, $options)
    {
        $this->identifier = $identifier;
        $this->label = (isset($options['label'])) ? $options['label'] : title_case($identifier);
        $this->sortable = (isset($options['sortable'])) ? $options['sortable'] : false;
    }

    public function sortable()
    {
        return $this->sortable;
    }

    public function type()
    {
        return $this->type;
    }

    public function label()
    {
        return $this->label;
    }

    public function identifier()
    {
        return $this->identifier;
    }
}