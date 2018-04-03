<?php

namespace App\DataGrid\Contracts;

interface Column {
    /**
     * Get the column identifier.
     */
    public function identifier();

    /**
     * Get the column label.
     */
    public function label();

    /**
     * Get the column type.
     */
    public function type();

    /**
     * Is column sortable?
     */
    public function sortable();
}