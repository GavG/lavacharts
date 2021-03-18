<?php

namespace Khill\Lavacharts\Support\Traits;

/**
 * Trait MaterialRenderableTrait
 *
 * When applied to a Chart, it will enable the output of the Chart in Material Design
 *
 * @package   Khill\Lavacharts\Support\Traits
 * @since     3.1.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2017, KHill Designs
 * @link      http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link      http://lavacharts.com                   Official Docs Site
 * @license   http://opensource.org/licenses/MIT      MIT
 */
trait MaterialRenderableTrait
{
    /**
     * Render as material or classic.
     *
     * @var bool
     */
    private $material = false;

    /**
     * Gets the chart render method.
     *
<<<<<<< HEAD
     * @param bool $material Sets the material render status.
     */
    public function setMaterialOutput($material)
    {
        $this->material = $material;
=======
     * @return bool Returns the material render status.
     */
    public function getMaterialOutput()
    {
        return $this->material;
>>>>>>> a4edf0a4d82aba848efa07ff10b537d640d4f91b
    }

    /**
     * Sets the chart to be rendered as material design or classic.
     *
     * @param bool $png Sets the material render status.
     */
    public function setMaterialOutput($png)
    {
        $this->material = (bool) $png;
    }
}
