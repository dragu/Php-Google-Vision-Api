<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\Landmark;
use Vision\Annotation\Position;
use Laminas\Hydrator\Strategy\StrategyInterface;

class LandmarkStrategy implements StrategyInterface
{
    /**
     * @param Landmark[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_map(function(Landmark $landmark) {
            return [
                'type' => $landmark->getType(),
                'position' => [
                    'x' => $landmark->getPosition()->getX(),
                    'y' => $landmark->getPosition()->getY(),
                    'z' => $landmark->getPosition()->getZ()
                ]
            ];
        }, $value);
    }

    /**
     * @param array $value
     * @return Landmark[]
     */
    public function hydrate($value, ?array $data)
    {
        $landmarks = [];

        foreach ($value as $landmarkInfo) {
            $position = $landmarkInfo['position'];

            $landmark = new Landmark();
            $landmark->setType($landmarkInfo['type']);
            $landmark->setPosition(
                new Position($position['x'], $position['y'], $position['z'])
            );

            $landmarks[] = $landmark;
        }

        return $landmarks;
    }
}
