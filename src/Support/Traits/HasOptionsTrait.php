<?php

namespace Khill\Lavacharts\Support\Traits;

use Khill\Lavacharts\Exceptions\InvalidArgumentException;
use Khill\Lavacharts\Support\Options;

/**
 * Trait HasOptionsTrait
 *
 * When applied to a class, then the class is able to have configured options tracked by
 * an Options object.
 *
 *
 * @package   Khill\Lavacharts\Support\Traits
 * @since     4.0.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright 2020 Kevin Hill
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
trait HasOptionsTrait
{
    /**
     * Options for the class.
     *
     * @var Options
     */
    protected $options;

    /**
     * Retrieves the Options object from the class.
     *
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Check if the instance has an option set.
     *
     * @param string $option
     * @return bool
     */
    public function hasOption($option)
    {
        return $this->options->has($option);
    }

    /**
     * Return whether or not the instance has any options.
     *
     * @return bool
     */
    public function hasOptions()
    {
        return count($this->options) > 0;
    }

    /**
     * Gets the value of an option.
     *
     * @param string $option
     * @return mixed|null
     */
    public function getOption($option)
    {
        return $this->options->get($option);
    }

    /**
     * Sets the value of an option.
     *
     * @param string $option
     * @param string $value
     */
    public function setOption($option, $value)
    {
        $this->options->set($option, $value);
    }

    /**
     * Sets the Options object for the class.
     *
     * @param array|Options $options
     * @throws \Khill\Lavacharts\Exceptions\InvalidArgumentException
     */
    public function setOptions($options)
    {
        $this->options = Options::create($options);
    }

    /**
     * Merges two sets of options.
     *
     * @param array|Options $options
     */
    public function mergeOptions($options)
    {
        $this->options->merge($options);
    }

    /**
     * Initialize the default options from file while overriding with user
     * passed values.
     *
     * @param array $options
     * @return void
     */
    public function initOptions(array $options)
    {
        $defaults = Options::getDefault();

        $this->setOptions($defaults);

        $this->options->merge($options);
    }
}
