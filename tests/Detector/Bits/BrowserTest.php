<?php

namespace BrowserDetectorTest\Detector\Bits;

use BrowserDetector\Detector\Bits\Browser;


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-07 at 12:49:35.
 */
class BrowserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Browser
     */
    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Browser('Test-User-Agent');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers BrowserDetector\Detector\Bits\Browser::getBits
     * @todo   Implement testGetBits().
     */
    public function testGetBits()
    {
        // Remove the following lines when you implement this test.
        static::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}