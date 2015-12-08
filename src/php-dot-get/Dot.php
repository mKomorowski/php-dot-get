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
     * Get value from given array
     * Return $default if value do not exists
     * @param array $array
     * @param string $keyPath
     * @return array|null
     */
    public function get(array $array, $keyPath)
    {
        return $this->extractValue($array, $keyPath);
    }

    /**
     * Check if value exists in given array and it is not null
     * @param array $array
     * @param string $keyPath
     * @return array|null
     */
    public function exists(array $array, $keyPath)
    {
        return $this->extractValue($array, $keyPath) !== null;
    }

    /**
     * Check if value match given assertion
     * @param array $array
     * @param string $keyPath
     * @param mixed $assertion
     * @return bool
     */
    public function assert(array $array, $keyPath, $assertion)
    {
        return $this->extractValue($array, $keyPath) === $assertion;
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