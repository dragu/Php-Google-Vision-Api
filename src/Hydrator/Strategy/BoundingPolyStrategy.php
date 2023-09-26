<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\BoundingPoly;
use Vision\Annotation\Vertex;
use Laminas\Hydrator\Strategy\StrategyInterface;

class BoundingPolyStrategy implements StrategyInterface
{
    public function extract($value, ?object $object = null)
    {
        $verticles = $value ? $value->getVertices() : [];
        $verticleMap = array_map(function(Vertex $vertex) {
            return array_filter([
                'x' => $vertex->getX(),
                'y' => $vertex->getY(),
            ]);
        }, $verticles);

        return [
            'vertices' => $verticleMap
        ];
    }

    public function hydrate($value, ?array $data)
    {
        $boundingPoly = new BoundingPoly;
        foreach ($value['vertices'] as $vertex) {
            $x = isset($vertex['x']) ? $vertex['x'] : null;
            $y = isset($vertex['y']) ? $vertex['y'] : null;

            $boundingPoly->addVertex(new Vertex($x, $y));
        }

        return $boundingPoly;
    }
}
