<?php

namespace BrowserDetectorTest\Detector\Version;

use BrowserDetector\Detector\Version\MicrosoftInternetExplorer;


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-07 at 12:50:57.
 */
class MicrosoftInternetExplorerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MicrosoftInternetExplorer
     */
    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new MicrosoftInternetExplorer('Test-User-Agent');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers BrowserDetector\Detector\Version\MicrosoftInternetExplorer::detectVersion
     * @todo   Implement testDetectVersion().
     */
    public function testDetectVersion()
    {
        // Remove the following lines when you implement this test.
        static::markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}