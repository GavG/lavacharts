<?php

namespace Khill\Lavacharts\Support\Contracts;

/**
 * ArrayAccess Interface
 *
 * Provides common methods for working with DataTables.
 *
 *
 * @package   Khill\Lavacharts\Support\Contracts
 * @since     4.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright 2020 Kevin Hill
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
interface IterableArray extends ArrayAccess
{
    /**
     * Create an The name of the class property that will be used for ArrayAccess
     *
     * @return \ArrayIterator
     */
    public function getIterator();
}
