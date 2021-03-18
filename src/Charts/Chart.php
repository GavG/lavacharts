<?php

namespace Khill\Lavacharts\Charts;

use Khill\Lavacharts\Exceptions\BadMethodCallException;
use Khill\Lavacharts\Javascript\ChartJsFactory;
use Khill\Lavacharts\Support\Buffer;
use Khill\Lavacharts\Support\Contracts\Customizable;
use Khill\Lavacharts\Support\Contracts\DataInterface;
use Khill\Lavacharts\Support\Contracts\JavascriptSource;
use Khill\Lavacharts\Support\Contracts\JsFactory;
use Khill\Lavacharts\Support\Contracts\JsPackage;
use Khill\Lavacharts\Support\Contracts\Wrappable;
use Khill\Lavacharts\Support\Renderable;
use Khill\Lavacharts\Support\Traits\HasDataTableTrait as HasDataTable;
use Khill\Lavacharts\Support\Traits\HasOptionsTrait as HasOptions;
use Khill\Lavacharts\Support\Traits\ToJavascriptTrait as ToJavascript;
use Khill\Lavacharts\Values\ElementId;
use Khill\Lavacharts\Values\Label;
<<<<<<< HEAD
use Khill\Lavacharts\Support\Traits\ElementIdTrait as HasElementId;
use Khill\Lavacharts\Support\Traits\DataTableTrait as HasDataTable;
use Khill\Lavacharts\Support\Traits\RenderableTrait as IsRenderable;
use Khill\Lavacharts\Support\Contracts\JsonableInterface as Jsonable;
use Khill\Lavacharts\Support\Contracts\WrappableInterface as Wrappable;
use Khill\Lavacharts\Support\Contracts\RenderableInterface as Renderable;
use Khill\Lavacharts\Support\Contracts\VisualizationInterface as Visualization;
=======
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b

/**
 * Class Chart
 *
 * Parent to all charts which has common properties and methods
 * used between all the different charts.
 *
 *
 * @package       Khill\Lavacharts\Charts
 * @author        Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link          http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link          http://lavacharts.com                   Official Docs Site
 * @license       http://opensource.org/licenses/MIT      MIT
 */
class Chart
    extends Renderable
    implements Customizable, /*JavascriptSource,*/ JsFactory, JsPackage, Wrappable
{
    use HasDataTable, HasOptions/*, ToJavascript*/;

    /**
     * Javascript type.
     *
     * @var string
     */
    const TYPE = 'Chart';

    /**
     * Type of wrappable class
     */
    const WRAP_TYPE = 'chartType';

    /**
     * Builds a new chart with the given label.
     *
     * @param Label         $label   Identifying label for the chart.
     * @param DataInterface $data    DataTable used for the chart.
     * @param array         $options Options fot the chart.
     */
    public function __construct(Label $label, DataInterface $data = null, array $options = [])
    {
        $this->setOptions($options);

        $this->label     = $label;
        $this->datatable = $data;

<<<<<<< HEAD
        $this->setExtendedAttributes();
    }

    /**
     * Set extended chart attributes from the assigned options, if present.
     *
     * @since 3.1.9
     */
    protected function setExtendedAttributes()
    {
        if (array_key_exists('elementId', $this->options)) {
            $this->setElementId($this->options['elementId']);

            unset($this->options['elementId']);
=======
        if ($this->options->has('elementId')) {
            $this->elementId = new ElementId($this->options->elementId);
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b
        }

        if (method_exists($this, 'setPngOutput') &&
            array_key_exists('png', $this->options))
            {
                $this->setPngOutput($this->options['png']);

                unset($this->options['png']);
            }

        if (method_exists($this, 'setMaterialOutput') &&
            array_key_exists('material', $this->options))
            {
                $this->setMaterialOutput($this->options['material']);

                unset($this->options['material']);
            }
    }


    /**
     * Returns the chart type.
     *
     * @since  3.0.0
     * @return string
     */
    public function getType()
    {
        return static::TYPE;
    }

    /**
     * Returns the Filter wrap type.
     *
     * @since  3.0.5
     * @return string
     */
    public function getWrapType()
    {
        return static::WRAP_TYPE;
    }

    /**
     * Returns the chart version.
     *
     * @since  3.0.5
     * @return string
     */
    public function getVersion()
    {
        return static::VERSION;
    }

    /**
     * Returns the chart visualization class.
     *
     * @since  3.0.5
     * @return string
     */
    public function getJsPackage()
    {
        return static::VISUALIZATION_PACKAGE;
    }

    /**
     * Returns the chart visualization package.
     *
     * @since  3.0.5
     * @return string
     */
    public function getJsClass()
    {
        return 'google.visualization.' . static::TYPE;
    }

    /**
     * Get the JsFactory for the chart.
     *
     * @return ChartJsFactory
     */
    public function getJsFactory()
    {
        return new ChartJsFactory($this);
    }

    /**
     * Array representation of the Chart.
     *
     * @return array
     */
    public function toArray()
    {
        if ( ! method_exists($this->datatable, 'getOptions')) {
            throw new BadMethodCallException($this->datatable, 'getOptions');
        }

        $this->mergeOptions($this->datatable->getOptions());

        return [
            'pngOutput'    => false,
            'chartType'    => $this->getType(),
            'events'       => $this->getEvents(),
            'formats'      => $this->getFormats(),
            'chartVer'     => $this->getVersion(),
            'chartClass'   => $this->getJsClass(),
            'chartOptions' => $this->getOptions(),
            'chartLabel'   => $this->getLabelStr(),
            'chartPackage' => $this->getJsPackage(),
            'elemId'       => $this->getElementId(),
            'chartData'    => $this->datatable->toJsDataTable(),
        ];
    }

    /**
     * Retrieves the events if any have been assigned to the chart.
     *
     *
     * If no events are defined, then an empty buffer will be returned.
     * Valid events will be converted to Javascriptable Event objects.
     *
     * @since  3.2.0
     * @return Buffer The contents will be javascript source
     */
    private function getEvents()
    {
        $buffer = new Buffer();

        if (!$this->options->has('events')) {
            return $buffer;
        }

        foreach ($this->options->events as $event => $callback) {
            $buffer->append(
                new Event($event, $callback)
            );
        }

        return $buffer;
    }

    /**
     * Retrieves the formats from the datatable that is defined on the chart.
     *
     *
     * The formats will be serialized down to javascript source and added
     * to a string buffer.
     *
     * If no formats are defined, then an empty buffer will be returned.
     *
     * @since  3.2.0
     * @return Buffer The contents will be javascript source
     */
    private function getFormats()
    {
        $buffer = new Buffer();

        if (!method_exists([$this->datatable], 'hasFormattedColumns')) {
//            throw new BadMethodCallException($this->datatable, 'hasFormattedColumns');
//        }

//        if (!$this->datatable->hasFormattedColumns()) {
            return $buffer;
        }

        /**
         * @var \Khill\Lavacharts\DataTables\Columns\Column $column
         */
        foreach ($this->datatable->getFormattedColumns() as $column) {
            $buffer->append(
                $column->getFormat()->toJavascript()
            );
        }

        return $buffer;
    }

    /**
     * Sets any configuration option, with no checks for type / validity
     *
     *
     * This is method was added in 2.5 as a band-aid to remove the handcuffs from
     * users who want to add options that Google has added, that I have not.
     * I didn't intend to restrict the user to only select options, as the
     * goal was to type isNonEmpty and validate. This method can be used to set
     * any option, just pass in arrays with key value pairs for any setting.
     *
     * If the setting is an object, per the google docs, then use multi-dimensional
     * arrays and they will be converted upon rendering.
     *
     * @deprecated 3.2.0
     * @since      3.0.0
     * @param  array $options Array of customization options for the chart
     * @return \Khill\Lavacharts\Charts\Chart
     */
    public function customize(array $options)
    {
        $this->setOptions($options);

        return $this;
    }
}
