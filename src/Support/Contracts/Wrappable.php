<?php

namespace Khill\Lavacharts\Support\Contracts;

/**
 * Wrappable Interface
 *
 * Classes that implement this can be wrapped for use in a Dashboard.
 *
 * @package   Khill\Lavacharts\Support\Contracts
 * @since     4.0.0 Extends Customizable
 * @since     3.1.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright 2020 Kevin Hill
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
interface Wrappable extends Customizable
{
    /**
     * Returns the type of the wrapped object.
     *
     * @return string
     */
    public function getType();

    /**
     * Returns the wrap type, either Control or Chart.
     *
     * @return string
     */
    public function getWrapType();
}
