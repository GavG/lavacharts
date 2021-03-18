<?php

namespace Khill\Lavacharts\Dashboards;

use Khill\Lavacharts\Javascript\DashboardJsFactory;
use Khill\Lavacharts\Values\Label;
use Khill\Lavacharts\Values\ElementId;
use Khill\Lavacharts\Dashboards\Bindings\Binding;
use Khill\Lavacharts\Dashboards\Bindings\BindingFactory;
use Khill\Lavacharts\Support\Renderable;
use Khill\Lavacharts\Support\Contracts\Customizable;
use Khill\Lavacharts\Support\Contracts\DataTable as DataInterface;
use Khill\Lavacharts\Support\Contracts\JsFactory;
use Khill\Lavacharts\Support\Contracts\JsPackage;
use Khill\Lavacharts\Support\Traits\HasOptionsTrait as HasOptions;
use Khill\Lavacharts\Support\Traits\HasDataTableTrait as HasDataTable;

/**
 * Class Dashboard
 *
 * This class is for creating interactive charts that have controls and filters.
 *
 * The dashboard takes filters, wrapped as controls, and charts to create a dynamic
 * display of data.
 *
 * @package   Khill\Lavacharts\Dashboards
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class Dashboard extends Renderable implements DataInterface, Customizable, JsFactory, JsPackage
{
    use HasDataTable, HasOptions;

    /**
     * Javascript type.
     *
     * @var string
     */
    const TYPE = 'Dashboard';

    /**
     * Google's dashboard version
     *
     * @var string
     */
    const VERSION = '1';

    /**
     * Javascript package.
     *
     * @var string
     */
    const VISUALIZATION_PACKAGE = 'controls';

    /**
     * Binding Factory for creating new bindings
     *
     * @var BindingFactory
     */
    private $bindingFactory;

    /**
     * Array of Binding objects, mapping controls to charts.
     *
     * @var Binding[]
     */
    private $bindings = [];

    /**
     * Builds a new Dashboard
     *
     * If passed an array of bindings, they will be applied upon creation.
     *
     * @param \Khill\Lavacharts\Values\Label                $label Label for the Dashboard
     * @param \Khill\Lavacharts\Support\Contracts\DataTable $datatable
     * @param \Khill\Lavacharts\Values\ElementId            $elementId Element Id for the Dashboard
     */
    public function __construct(Label $label, DataInterface $data, ElementId $elementId = null)
    {
        $this->bindingFactory = new BindingFactory;

        $this->label     = $label;
        $this->datatable = $data;
        $this->elementId = $elementId;
    }

    /**
     * Returns the chart type.
     *
     * @since 3.1.0
     * @return string
     */
    public function getType()
    {
        return static::TYPE;
    }

    /**
     * Returns the javascript visualization package name
     *
     * @return string
     */
    public function getJsPackage()
    {
        return static::VISUALIZATION_PACKAGE;
    }

    /**
     * Returns the javascript visualization class name
     *
     * @return string
     */
    public function getJsClass()
    {
        return 'google.visualization.Dashboard';
    }

    /**
     * Get the JsFactory for the chart.
     *
     * @return DashboardJsFactory
     */
    public function getJsFactory()
    {
        return new DashboardJsFactory($this);
    }

    /**
     * Fetch the dashboard's bound charts from the wrappers.
     *
     * @return array
     */
    public function getBoundCharts()
    {
        $charts = [];

        foreach ($this->bindings as $binding) {
            foreach ($binding->getChartWrappers() as $chartWrapper) {
                $chart = $chartWrapper->unwrap();

                $charts[] = $chart;
            }
        }

        return $charts;
    }

    /**
     * Binds ControlWrappers to ChartWrappers in the dashboard.
     *
     * - A OneToOne binding is created if single wrappers are passed.
     * - If a single ControlWrapper is passed with an array of ChartWrappers,
     *   a OneToMany binding is created.
     * - If an array of ControlWrappers is passed with one ChartWrapper, then
     *   a ManyToOne binding is created.
     * - If an array of ControlWrappers is passed with and array of ChartWrappers, then
     *   a ManyToMany binding is created.
     *
     * @param  \Khill\Lavacharts\Dashboards\Wrappers\ControlWrapper|array $controlWraps
     * @param  \Khill\Lavacharts\Dashboards\Wrappers\ChartWrapper|array   $chartWraps
     * @return \Khill\Lavacharts\Dashboards\Dashboard
     * @throws \Khill\Lavacharts\Exceptions\InvalidBindings
     */
    public function bind($controlWraps, $chartWraps)
    {
        $this->bindings[] = $this->bindingFactory->create($controlWraps, $chartWraps);

        return $this;
    }

    /**
     * Batch add an array of bindings.
     *
     * This method can set all bindings at once instead of chaining multiple bind methods.
     *
     * @param  array $bindings
     * @return \Khill\Lavacharts\Dashboards\Dashboard
     * @throws \Khill\Lavacharts\Exceptions\InvalidBindings
     */
    public function setBindings(array $bindings)
    {
        $this->bindings = array_map(function ($bindingPair) {
            return $this->bindingFactory->create($bindingPair[0], $bindingPair[1]);
        }, $bindings);

        return $this;
    }

    /**
     * Fetch the dashboard's bindings.
     *
     * @return Binding[]
     */
    public function getBindings()
    {
        return $this->bindings;
    }

    /**
     * Returns the type of renderable.
     *
     * @return string
     */
    public function getRenderableType()
    {
        // TODO: Implement getRenderableType() method.
    }

    /**
     * Array representation of the Chart.
     *
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
