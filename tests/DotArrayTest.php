<?php

use mKomorowski\Notation\Dot;

class DotTest extends PHPUnit_Framework_TestCase
{
    protected $dot;
    protected $sampleArray = array(
        'name' => 'test',
        'continent' => array(
            'Europe' => array(
                'Neverland' => array(
                    'isReal' => false
                )
            )
        ),
        'values' => array(
            'null' => null,
            'false' => false,
            'array' => array()
        ),
        'sober' => true
    );

    public function setUp()
    {
        $this->dot = new Dot;
    }

    /**
     * @dataProvider getProvider
     */
    public function testGetReturnCorrectArgument($key, $expectation)
    {
        $value = $this->dot->get($this->sampleArray, $key);

        $this->assertEquals($expectation, $value);
    }

    public function testDefaultReturnDefaultIfKeyNotFound()
    {
        $default = 'default';
        $this->dot->setDefault($default);
        $value = $this->dot->get($this->sampleArray, 'nonExists.key.something');

        $this->assertEquals($default, $value);
    }

    public function getProvider()
    {
        return array(
            array('sober', true),
            array('name', 'test'),
            array('nonExisting', null),
            array('continent.Europe.Neverland.isReal', false),
            array('continent.Europe.Neverland', array('isReal' => false)),
            array('values.null', null),
            array('values.false', false),
            array('values.array', array()),
            array(null, null)
        );
    }
}