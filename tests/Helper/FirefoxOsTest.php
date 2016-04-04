<?php

namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper\FirefoxOs;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class FirefoxOsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsFirefoxOsPositive
     *
     * @param string $agent
     */
    public function testIsFirefoxOsPositive($agent)
    {
        self::assertTrue((new FirefoxOs($agent))->isFirefoxOs());
    }

    public function providerIsFirefoxOsPositive()
    {
        return [
            ['Mozilla/5.0 (Mobile; ALCATELOneTouch4012X/SVN 01010B; rv:18.1) Gecko/18.1 Firefox/18.1'],
        ];
    }

    /**
     * @dataProvider providerIsFirefoxOsNegative
     *
     * @param string $agent
     */
    public function testIsFirefoxOsNegative($agent)
    {
        self::assertFalse((new FirefoxOs($agent))->isFirefoxOs());
    }

    public function providerIsFirefoxOsNegative()
    {
        return [
            ['Mozilla/5.0 (Linux; U; Android 4.3; de-de; SAMSUNG GT-I9305/I9305XXUEMKC Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'],
            ['Mozilla/5.0 (Android; Tablet; rv:15.0) Gecko/15.0 Firefox/15.0.1'],
            ['Mozilla/5.0 (Android; Mobile; rv:15.0) Gecko/15.0 Firefox/15.0'],
            ['Mozilla/5.0 (Android; Tablet; rv:23.0) Gecko/23.0 Firefox/23.0'],
            ['Mozilla/5.0 (Android; Mobile; rv:16.0) Gecko/16.0 Firefox/16.0'],
            ['Mozilla/5.0 (Android; Tablet; rv:24.0) Gecko/24.0 Firefox/24.0'],
        ];
    }
}
