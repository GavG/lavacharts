<?php

namespace Khill\Lavacharts\Dashboards\Wrappers;

use Khill\Lavacharts\Support\Contracts\Arrayable;
use Khill\Lavacharts\Support\Contracts\JsClass;
use Khill\Lavacharts\Support\Contracts\Jsonable;
use Khill\Lavacharts\Support\Contracts\Wrappable;
use Khill\Lavacharts\Support\Traits\ArrayToJsonTrait as ArrayToJson;
use Khill\Lavacharts\Support\Traits\HasElementIdTrait as HasElementId;

/**
 * Abstract Wrapper Class
 *
 * The control and chart wrappers extend this for common methods.
 *
 *
 * @package   Khill\Lavacharts\Dashboards\Wrappers
 * @since     3.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright 2020 Kevin Hill
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
abstract class Wrapper implements Arrayable, Jsonable, JsClass
{
    use HasElementId, ArrayToJson;

    /**
     * The contents of the wrap, either Chart or Filter.
     *
     * @var Wrappable
     */
    protected $contents;

    /**
     * Returns a string of the javascript visualization class for the Wrapper.
     *
     * @return string
     */
    abstract public function getJsClass();

    /**
     * Builds a new Wrapper object.
     *
     * @param Wrappable $wrappable
     * @param string    $elementId
     * @internal param Wrappable $itemToWrap
     */
    public function __construct(Wrappable $wrappable, $elementId)
    {
        $this->contents = $wrappable;

        $this->setElementId($elementId);
    }

    /**
     * Unwraps and returns the wrapped object.
     *
     * @return Wrappable
     */
    public function unwrap()
    {
        return $this->contents;
    }

    /**
     * Array representation of the Wrapper
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'containerId' => $this->elementId,
            'options'     => $this->contents->getOptions(),
            $this->contents->getWrapType() => $this->contents->getType()
        ];
    }
}
