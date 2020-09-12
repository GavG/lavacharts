<?php

namespace Khill\Lavacharts\Support;

use Khill\Lavacharts\Exceptions\InvalidArgumentException;
use Khill\Lavacharts\Exceptions\UndefinedOptionException;
use Khill\Lavacharts\Support\Contracts\Arrayable;
use Khill\Lavacharts\Support\Contracts\Jsonable;
use Khill\Lavacharts\Support\Traits\ArrayToJsonTrait as ArrayToJson;

/**
 * Options Class
 *
 * Lightweight wrapper for what would be an array of options. Useful for converting
 * to json or chaining from what has set options.
 *
 * @category  Class
 * @package   Khill\Lavacharts\Support
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright 2020 Kevin Hill
 * @license   http://opensource.org/licenses/MIT      MIT
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository
 * @link      http://lavacharts.com                   Official Docs Site
 * @since     4.0.0
 */
class Options extends ArrayObject implements Arrayable, Jsonable
{
    use ArrayToJson;

    /**
     * Customization options.
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new Options object from an array or another Options object.
     *
     * @param array|Options $options
     *
     * @return Options
     * @throws InvalidArgumentException
     */
    public static function create($options)
    {
        if (! $options instanceof Options && ! is_array($options)) {
            throw new InvalidArgumentException($options, 'array or Options object');
        }

        if ($options instanceof Options) {
            $options = $options->toArray();
        }

        return new static($options);
    }

    /**
     * Returns the default configuration options for Lavacharts
     *
     * @return array
     */
    public static function getDefault()
    {
        return include __DIR__.'/../Laravel/config/lavacharts.php';
    }

    /**
     * Returns a list of the options that can be set.
     *
     * @return array
     */
    public static function getAvailable()
    {
        return array_keys(self::getDefault());
    }

    /**
     * Customizable constructor.
     *
     * @param array $options Customization options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * When treating options as a string, assume they are getting serialized.
     *
     * @public
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Retrieve options as member properties
     *
     * @public
     * @param  string $option
     * @return mixed
     * @throws \Khill\Lavacharts\Exceptions\UndefinedOptionException
     */
    public function __get($option)
    {
        if (! $this->has($option)) {
            throw new UndefinedOptionException($option);
        }

        return $this->options[$option];
    }

    /**
     * Setting an option by assigning to the class property.
     *
     * @public
     * @param string $option
     * @param mixed  $value
     */
    public function __set($option, $value)
    {
        $this->options[$option] = $value;
    }

    /**
     * Return the string name of the property that will be used for ArrayAccess
     *
     * @public
     * @return string
     */
    public function getArrayAccessProperty()
    {
        return 'options';
    }

    /**
     * Check if an option has been set.
     *
     * @param string $option
     * @return bool
     */
    public function has($option)
    {
        return array_key_exists($option, $this->options);
    }

    /**
     * Check if an option has been set and is of a certain type.
     *
     * @param string $option
     * @param string $type
     * @return bool
     */
    public function hasAndIs($option, $type)
    {
        return $this->has($option) && gettype($this->get($option)) === $type;
    }

    /**
     * Check if an option has been set and is of a certain type.
     *
     * @param string $option
     * @param mixed  $value
     * @return bool
     */
    public function hasAndEquals($option, $value)
    {
        return $this->has($option) && $this->get($option) === $value;
    }

    /**
     * Get the value of an option.
     *
     * @param string $option Option to get
     * @return mixed|null
     * @throws UndefinedOptionException
     */
    public function get($option)
    {
        if (! $this->has($option)) {
            throw new UndefinedOptionException($option);
        }

        return $this->options[$option];
    }

    /**
     * Sets the value of the given option.
     *
     * @param string $option
     * @param mixed  $value
     * @return self
     */
    public function set($option, $value)
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * Sets the value of the given option if it does not exist.
     *
     * Value is left unchanged if it is already set.
     *
     * @param  string $option
     * @param  mixed  $value
     * @return self
     */
    public function setIfNot($option, $value)
    {
        if (! $this->has($option)) {
            $this->options[$option] = $value;
        }

        return $this;
    }

    /**
     * Delete an option from the set.
     *
     * @param  string $option
     * @return self
     * @throws UndefinedOptionException
     */
    public function forget($option)
    {
        if (! $this->has($option)) {
            throw new UndefinedOptionException($option);
        }

        unset($this->options[$option]);

        return $this;
    }

    /**
     * Remove an option from the set.
     *
     * @param  string $option
     * @return mixed
     * @throws UndefinedOptionException
     */
    public function pop($option)
    {
        if (! $this->has($option)) {
            throw new UndefinedOptionException($option);
        }

        $value = $this->options[$option];

        $this->forget($option);

        return $value;
    }

    /**
     * Merge a set of options with the existing options.
     *
     * @param array|Options $options
     * @return self
     */
    public function merge($options)
    {
        if ($options instanceof Options) {
            $options = $options->toArray();
        }

        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Returns the options without the options specified.
     *
     * @param string|array $options
     * @return Options
     */
    public function without($options)
    {
        if (is_string($options)) {
            $options = [$options];
        }

        $without = [];

        foreach ($options as $key) {
            $without[$key] = null;
        }

        return new static(array_diff_key($this->options, $without));
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->options;
    }
}
