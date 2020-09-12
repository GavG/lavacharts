<?php

namespace Khill\Lavacharts\Support\Contracts;

/**
 * JsPackage Interface
 *
 * Classes that implement this provide a method for custom JSON output.
 *
 * @package   Khill\Lavacharts\Support\Contracts
 * @since     3.1.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright 2020 Kevin Hill
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
interface Visualization extends JsClass
{
    /**
     * Returns the name of the Javascript object of a Google chart component.
     *
     * @return string
     */
    public function getJsPackage();
}
