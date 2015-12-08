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
                    'isReal' => false,
                    'capital' => 'Capital'
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
    public function testGetReturnCorrectValue($key, $expectation)
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

    public function testExistsReturnCorrectValue()
    {
        $this->assertFalse($this->dot->exists($this->sampleArray, 'values.undefined'));
        $this->assertTrue($this->dot->exists($this->sampleArray, 'values.false'));
        $this->assertFalse($this->dot->exists($this->sampleArray, 'values.null'));
        $this->assertTrue($this->dot->exists($this->sampleArray, 'values.array'));
    }

    public function testAssertReturnCorrectValue()
    {
        $this->assertTrue($this->dot->assert($this->sampleArray, 'values.false', false));
        $this->assertTrue($this->dot->assert($this->sampleArray, 'continent.Europe.Neverland.capital', 'Capital'));
        $this->assertFalse($this->dot->assert($this->sampleArray, 'continent.Europe.Neverland.capital', 'capital'));
        $this->assertFalse($this->dot->assert($this->sampleArray, 'values.undefined', false));
    }

    public function getProvider()
    {
        return array(
            array('sober', true),
            array('name', 'test'),
            array('nonExisting', null),
            array('continent.Europe.Neverland.isReal', false),
            array('continent.Europe.Neverland', array('isReal' => false, 'capital' => 'Capital')),
            array('values.null', null),
            array('values.false', false),
            array('values.array', array()),
            array(null, null)
        );
    }
}