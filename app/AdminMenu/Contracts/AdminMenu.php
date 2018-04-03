<?php

namespace App\AdminMenu\Contracts;

interface AdminMenu {

    /**
     * Get/Set AdminMenu Key
     */

    public function key();
    /**
     * Get/Set AdminMenu Label
     */
    public function label();

    /**
     * Get/Set AdminMenu Route Name
     */
    public function route();
}