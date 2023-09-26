<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\Property;
use Vision\Annotation\WebEntity;
use Laminas\Hydrator\Strategy\StrategyInterface;

class WebEntitiesStrategy implements StrategyInterface
{
    /**
     * @param WebEntity[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_map(function(WebEntity $webEntity) {
            return array_filter([
                'entityId' => $webEntity->getEntityId(),
                'score' => $webEntity->getScore(),
                'description' => $webEntity->getDescription(),
            ]);
        }, $value);
    }

    /**
     * @param array $value
     * @return WebEntity[]
     */
    public function hydrate($value, ?array $data)
    {
        $webEntities = [];

        foreach ($value as $webEntityInfo) {
            $webEntities[] = new WebEntity(
                $webEntityInfo['entityId'],
                isset($webEntityInfo['description']) ? $webEntityInfo['description'] : null,
                isset($webEntityInfo['score']) ? $webEntityInfo['score'] : null
            );
        }

        return $webEntities;
    }
}
