<?php namespace mKomorowski\Notation;

/**
 * Class Dot
 * @package mKomorowski\Notation
 */
class Dot
{
    const DELIMITER = '.';

    /**
     * @var null
     */
    protected $default = null;

    /**
     * @param mixed $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @param array $array
     * @param string $keyPath
     * @return array|null
     */
    public function get(array $array, $keyPath)
    {
        return $this->extractValue($array, $keyPath);
    }

    /**
     * @param array $array
     * @param string $keyPath
     * @return array|null
     */
    protected function extractValue($array, $keyPath)
    {
        if(gettype($keyPath) !== 'string') {
            return $this->default;
        }

        $keys = explode(self::DELIMITER, $keyPath);

        foreach($keys as $key) {
            if(isset($array[$key])) {
                $array = $array[$key];
            } else {
                return $this->default;
            }
        }

        return $array;
    }
}