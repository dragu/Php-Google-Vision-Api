<?php

namespace Vision\Tests\Hydrator\Strategy;

use PHPUnit\Framework\TestCase;
use Vision\Annotation\Landmark;
use Vision\Annotation\Position;
use Vision\Hydrator\Strategy\LandmarkStrategy;

class LandmarkStrategyTest extends TestCase
{
    public function testHydratesArray()
    {
        $strategy = new LandmarkStrategy();
        $objects = $strategy->hydrate($this->getArray(), null);

        $this->assertEquals($this->getObjects(), $objects);
    }

    public function testExtractsObject()
    {
        $strategy = new LandmarkStrategy();
        $array = $strategy->extract($this->getObjects());

        $this->assertEquals($this->getArray(), $array);
    }

    /**
     * @return array
     */
    protected function getArray()
    {
        return [
            [
                'type' => 'a',
                'position' => [
                    'x' => 12,
                    'y' => 34,
                    'z' => 56,
                ],
            ],
            [
                'type' => 'b',
                'position' => [
                    'x' => 33,
                    'y' => 44,
                    'z' => 55,
                ],
            ],
        ];
    }

    /**
     * @return Landmark[]
     */
    protected function getObjects()
    {
        $landmarkA = new Landmark();
        $landmarkA->setType('a');
        $landmarkA->setPosition(
            new Position(12, 34, 56)
        );

        $landmarkB = new Landmark();
        $landmarkB->setType('b');
        $landmarkB->setPosition(
            new Position(33, 44, 55)
        );

        return [$landmarkA, $landmarkB];
    }
}
