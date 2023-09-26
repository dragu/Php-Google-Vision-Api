<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\TextProperty;
use Laminas\Hydrator\Strategy\StrategyInterface;

class TextPropertyStrategy implements StrategyInterface
{
    /**
     * @var DetectedLanguagesStrategy
     */
    protected $detectedLanguagesStrategy;

    /**
     * @var DetectedBreakStrategy
     */
    protected $detectedBreakStrategy;


    public function __construct()
    {
        $this->detectedLanguagesStrategy = new DetectedLanguagesStrategy;
        $this->detectedBreakStrategy = new DetectedBreakStrategy;
    }

    /**
     * @param TextProperty $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_filter([
            'detectedLanguages' => $this->detectedLanguagesStrategy->extract($value->getDetectedLanguages()),
            'detectedBreak' => $this->detectedBreakStrategy->extract($value->getDetectedBreak()),
        ]);

    }

    /**
     * @param array $value
     * @return TextProperty
     */
    public function hydrate($value, ?array $data)
    {
        return new TextProperty(
            isset($value['detectedLanguages']) ? $this->detectedLanguagesStrategy->hydrate($value['detectedLanguages'], null) : [],
            isset($value['detectedBreak']) ? $this->detectedBreakStrategy->hydrate($value['detectedBreak'], null) : null
        );
    }
}
