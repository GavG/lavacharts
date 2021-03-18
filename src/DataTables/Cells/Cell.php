<?php

namespace Khill\Lavacharts\DataTables\Cells;

use Khill\Lavacharts\Exceptions\InvalidArgumentException;
use Khill\Lavacharts\Support\Contracts\Arrayable;
use Khill\Lavacharts\Support\Contracts\Customizable;
use Khill\Lavacharts\Support\Contracts\Jsonable;
use Khill\Lavacharts\Support\Traits\ArrayToJsonTrait as ArrayToJson;
use Khill\Lavacharts\Support\Traits\HasOptionsTrait as HasOptions;
use Khill\Lavacharts\Values\StringValue;

/**
 * DataCell Object
 *
 * Holds the information for a data point
 *
 * @package   Khill\Lavacharts\DataTables\Cells
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
class Cell implements Customizable, Arrayable, Jsonable
{
    use HasOptions, ArrayToJson;

    /**
     * The cell value.
     *
     * @var string
     */
    protected $value;

    /**
     * A string version of the value. (Optional)
     *
     * @var string
     */
    protected $format;

    /**
     * Create a new Cell from an array of arguments for the constructor.
     *
     * @param array $cellDef
     * @return Cell
     */
    public static function create($cellDef)
    {
        return call_user_func_array([Cell::class, '__construct'], $cellDef);
    }

    /**
     * Defines a Cell for a DataTable
     *
     * Each cell in the table holds a value. Cells optionally can take a
     * "formatted" version of the data; this is a string version of the data,
     * formatted for display by a visualization. A visualization can (but is
     * not required to) use the formatted version for display, but will always
     * use the data itself for any sorting or calculations that it makes (such
     * as determining where on a graph to place a point). An example might be
     * assigning the values "low" "medium", and "high" as formatted values to
     * numeric cell values of 1, 2, and 3.
     *
     *
     * @param  string $value   The cell value
     * @param  string $format  A string version of the v value
     * @param  array  $options A map of custom values applied to the cell
     * @throws \Khill\Lavacharts\Exceptions\InvalidParamType
     */
    public function __construct($value, $format = null, array $options = [])
    {
        if (StringValue::isNonEmpty($format) || $format === null) {
            $this->format = $format;
        } else {
            throw new InvalidArgumentException($format, 'string');
        }

        $this->value = $value;

        $this->setOptions($options);
    }

    /**
     * Mapping the 'p' attribute of the cell to it's options.
     *
     * @deprecated 3.2.0 Why did I add this?
     * @since  3.1.0
     * @param  string $attr
     * @return array
     */
    public function __get($attr)
    {
        if ($attr == 'p') {
            return $this->options->toArray();
        }
    }

    /**
     * Allowing the 'p' attribute to be checked for options by using the hasOptions method.
     *
     * @deprecated 3.2.0 Why did I add this?
     * @since  3.1.0
     * @param  string $attr
     * @return bool
     */
    function __isset($attr)
    {
        if ($attr == 'p') {
            return $this->hasOptions();
        }
    }

    /**
     * Returns the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the string format of the value.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Return the Cell as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $cell = ['v' => $this->value];

        if ($this->format !== null) {
            $cell['f'] = $this->format;
        }

        if ($this->hasOptions()) {
            $cell['p'] = $this->options->toArray();
        }

        return $cell;
    }
}
