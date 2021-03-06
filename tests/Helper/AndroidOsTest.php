<?php

namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class AndroidOsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsiOSPositive
     *
     * @param string $agent
     */
    public function testIsAndroidOsPositive($agent)
    {
        self::assertTrue((new Helper\AndroidOs($agent))->isAndroid());
    }

    public function providerIsiOSPositive()
    {
        return [
            ['Mozilla/5.0 (X11; U; Linux x86_64; en-gb) AppleWebKit/537.36 (KHTML, like Gecko)  Chrome/30.0.1599.114 Safari/537.36 Puffin/4.1.1.1119AP'],
            ['Mozilla/5.0 (Linux; U; en-us; BeyondPod 4)'],
        ];
    }

    /**
     * @dataProvider providerIsiOSNegative
     *
     * @param string $agent
     */
    public function testIsAndroidOsNegative($agent)
    {
        self::assertFalse((new Helper\AndroidOs($agent))->isAndroid());
    }

    public function providerIsiOSNegative()
    {
        return [
            ['Microsoft Office Excel 2013'],
            ['Mozilla/5.0 (X11; U; Linux Core i7-4980HQ; de; rv:32.0; compatible; Jobboerse.com; http://www.xn--jobbrse-d1a.com) Gecko/20100401 Firefox/24.0'],
            ['Mozilla/5.0 (compatible; MSIE or Firefox mutant; not on Windows server; + http://tab.search.daum.net/aboutWebSearch.html) Daumoa/3.0'],
            ['amarok/2.8.0 (Phonon/4.8.0; Phonon-VLC/0.8.0) LibVLC/2.2.1'],
            ['Mozilla/4.0 (compatible; MSIE 6.0; Windows 95; PalmSource; Blazer 3.0) 16; 160x160'],
            ['Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; 240x320; SPV M700; OpVer 19.123.2.733) OrangeBot-Mobile 2008.0 (mobilesearch.support@orange-ftgroup.com)'],
            ['Mozilla/5.0 (X11; U; Linux x86_64; ar-SA) AppleWebKit/534.35 (KHTML, like Gecko)  Chrome/11.0.696.65 Safari/534.35 Puffin/3.11546IP'],
        ];
    }
}
