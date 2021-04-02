<?php

namespace App\Tweets\Entities;

class EntityExtractor
{
    protected $string;
    const HASH_TAG_REGEX = '/(?!\s)#([a-zA-Z]\w*)\b/';
    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }
    
    /**
     * Preg match Hash Tag entities
     * @return void
     */
    public function getHashTagEntities()
    {
        return $this->buildEntityCollection($this->match(self::HASH_TAG_REGEX), 'hashTag');
    }

    /**
     * @param $entities
     * @param $type
     */

    protected function buildEntityCollection($entities, $type)
    {
        return array_map(function($entity, $index) use($entities, $type) {
            return [
                'body' => $entity[0],
                'body_plain' => $entities[1][$index][0],
                'start' => $start = $entity[1],
                'end' => $start + strlen($entity[1]),
                'type' => $type
            ];
        }, $entities[0], array_keys($entities[0]));
    }

    /**
     * Match entites
     * @param $pattern
     */
    public function match($pattern)
    {
        preg_match_all($pattern, $this->string, $matches, PREG_OFFSET_CAPTURE);
        return $matches;
    }
}