<?php

namespace Khill\Lavacharts\Tests\Dashboards;

use Khill\Lavacharts\Charts\Chart;
use Khill\Lavacharts\Charts\LineChart;
use Khill\Lavacharts\Dashboards\Filter;
use Khill\Lavacharts\Dashboards\Wrappers\ChartWrapper;
use Khill\Lavacharts\Dashboards\Wrappers\ControlWrapper;
use Khill\Lavacharts\DataTables\DataTable;
use Khill\Lavacharts\Tests\Charts\MockChart;
use Khill\Lavacharts\Tests\ProvidersTestCase;
use Mockery;

class DashboardsTestCase extends ProvidersTestCase
{
    /**
     * @var Chart
     */
    protected $mockChart;

    /**
     * @var ChartWrapper
     */
    protected $mockChartWrap;

    /**
     * @var ControlWrapper
     */
    protected $mockControlWrap;

    public function setUp()
    {
        parent::setUp();

        $this->mockChartWrap = Mockery::mock(
            ChartWrapper::class,
            [
                'LineChart',
                'chart-div'
            ]
        );
        $this->mockChartWrap
        ->shouldReceive('setElementId')
        ->once()
        ->with('chart-div')
        ->andSet('elementId', 'chart-div');

        $this->mockControlWrap = Mockery::mock(
            ControlWrapper::class,
            [
                Mockery::mock(Filter::class, ['NumberRange', 1]),
                'control-div'
            ]
        );
    }
}
