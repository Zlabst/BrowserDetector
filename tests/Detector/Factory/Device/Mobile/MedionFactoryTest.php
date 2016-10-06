<?php

namespace BrowserDetectorTest\Detector\Factory\Device\Mobile;

use BrowserDetector\Detector\Factory\Device\Mobile\MedionFactory;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class MedionFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerDetect
     *
     * @param string $agent
     * @param string $deviceName
     * @param string $marketingName
     * @param string $manufacturer
     * @param string $brand
     * @param string $deviceType
     * @param bool   $dualOrientation
     * @param string $pointingMethod
     */
    public function testDetect($agent, $deviceName, $marketingName, $manufacturer, $brand, $deviceType, $dualOrientation, $pointingMethod)
    {
        /** @var \UaResult\Device\DeviceInterface $result */
        $result = MedionFactory::detect($agent);

        self::assertInstanceOf('\UaResult\Device\DeviceInterface', $result);

        self::assertSame(
            $deviceName,
            $result->getDeviceName(),
            'Expected device name to be "' . $deviceName . '" (was "' . $result->getDeviceName() . '")'
        );
        self::assertSame(
            $marketingName,
            $result->getMarketingName(),
            'Expected marketing name to be "' . $marketingName . '" (was "' . $result->getMarketingName() . '")'
        );
        self::assertSame(
            $manufacturer,
            $result->getManufacturer(),
            'Expected manufacturer name to be "' . $manufacturer . '" (was "' . $result->getManufacturer() . '")'
        );
        self::assertSame(
            $brand,
            $result->getBrand(),
            'Expected brand name to be "' . $brand . '" (was "' . $result->getBrand() . '")'
        );
        self::assertSame(
            $deviceType,
            $result->getType()->getName(),
            'Expected device type to be "' . $deviceType . '" (was "' . $result->getType()->getName() . '")'
        );
        self::assertSame(
            $dualOrientation,
            $result->getDualOrientation(),
            'Expected dual orientation to be "' . $dualOrientation . '" (was "' . $result->getDualOrientation() . '")'
        );
        self::assertSame(
            $pointingMethod,
            $result->getPointingMethod(),
            'Expected pointing method to be "' . $pointingMethod . '" (was "' . $result->getPointingMethod() . '")'
        );
    }

    /**
     * @return array[]
     */
    public function providerDetect()
    {
        return [
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; LIFETAB_P733X Build/LRX22L) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Safari/537.36',
                'LifeTab P733X',
                'LifeTab P733X',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.4; LIFETAB_P1034X Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Safari/537.36',
                'LifeTab P1034X',
                'LifeTab P1034X',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Dalvik/2.1.0 (Linux; U; Android 5.1.1; LIFETAB_S1034X Build/LMY47V)',
                'LifeTab S1034X',
                'LifeTab S1034X',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; MEDION E5001 Build/MEDION-E5001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'Life E5001',
                'Life E5001',
                'Medion',
                'Medion',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; LIFETAB_E7316 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Safari/537.36',
                'MD 98282',
                'LifeTab E7316',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 5.0.2; de-de; LIFETAB_P891X Build/LRX22L) AppleWebKit/537.16 (KHTML, like Gecko) Version/4.0 Safari/537.16 Chrome/33.0.0.0',
                'LifeTab P891X',
                'LifeTab P891X',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; LIFETAB_S1033X Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36',
                'LifeTab S1033X',
                'LifeTab S1033X',
                'Lenovo',
                'Lenovo',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1.1; LIFETAB_S1036X Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Safari/537.36',
                'LifeTab S1036X',
                'LifeTab S1036X',
                'Lenovo',
                'Lenovo',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; de-de; LIFETAB_S9714 Build/JRO03R) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'LifeTab S9714',
                'LifeTab S9714',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.3; de-de; MD_LIFETAB_P9516 Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'LifeTab P9516',
                'LifeTab P9516',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; LIFETAB_S831X Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36',
                'LifeTab S831X',
                'LifeTab S831X',
                'Lenovo',
                'Lenovo',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; LIFETAB_S785X Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Safari/537.36',
                'LifeTab S785X',
                'LifeTab S785X',
                'Lenovo',
                'Lenovo',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; LIFETAB_P831X.2 Build/LRX22L) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Safari/537.36',
                'LifeTab P831X.2',
                'LifeTab P831X.2',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; MEDION X5004 Build/MEDION-X5004; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/50.0.2661.86 Mobile Safari/537.36',
                'X5004',
                'X5004',
                'Medion',
                'Medion',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.0.3; LIFETAB_P9514 Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Safari/537.36',
                'LifeTab P9514',
                'LifeTab P9514',
                'Medion',
                'Medion',
                'Tablet',
                true,
                'touchscreen',
            ],
        ];
    }
}
