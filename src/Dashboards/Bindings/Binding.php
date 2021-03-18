<?php

namespace Khill\Lavacharts\Dashboards\Bindings;

use Khill\Lavacharts\Dashboards\Wrappers\ChartWrapper;
use Khill\Lavacharts\Dashboards\Wrappers\ControlWrapper;

/**
 * Parent Binding Class
 *
 * Binds a ControlWrapper to a ChartWrapper to use in dashboards.
 *
 * @package   Khill\Lavacharts\Dashboards\Bindings
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class Binding
{
    /**
     * Array of ControlWrappers.
     *
     * @var ControlWrapper[]
     */
    protected $controlWrappers;

    /**
     * Array of ChartWrappers.
     *
     * @var ChartWrapper[]
     */
    protected $chartWrappers;

    /**
     * Assigns the wrappers and creates the new Binding.
     *
     * @param ChartWrapper[] $chartWrappers
     * @param ControlWrapper[] $controlWrappers
     */
    public function __construct(array $controlWrappers, array $chartWrappers)
    {
        $this->chartWrappers   = $chartWrappers;
        $this->controlWrappers = $controlWrappers;
    }

    /**
     * Get the ChartWrappers
     *
     * @return ChartWrapper[]
     */
    public function getChartWrappers()
    {
        return $this->chartWrappers;
    }

    /**
     * Get the a specific ChartWrap
     *
     * @since  3.1.0
     * @param  int $index Which chart wrap to retrieve
     * @return ChartWrapper
     */
    public function getChartWrap($index)
    {
        return $this->chartWrappers[$index];
    }

    /**
     * Get the ControlWrappers
     *
     * @return ControlWrapper[]
     */
    public function getControlWrappers()
    {
        return $this->controlWrappers;
    }

    /**
     * Get the a specific ControlWrap
     *
     * @since  3.1.0
     * @param  int $index Which control wrap to retrieve
     * @return ControlWrapper
     */
    public function getControlWrap($index)
    {
        return $this->controlWrappers[$index];
    }
}
