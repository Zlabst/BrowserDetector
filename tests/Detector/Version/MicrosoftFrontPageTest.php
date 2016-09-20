<?php

namespace BrowserDetectorTest\Detector\Version;

use BrowserDetector\Detector\Version\MicrosoftFrontPage;


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-07 at 12:50:57.
 */
class MicrosoftFrontPageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MicrosoftFrontPage
     */
    private $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new MicrosoftFrontPage('Test-User-Agent');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers BrowserDetector\Detector\Version\MicrosoftFrontPage::detectVersion
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