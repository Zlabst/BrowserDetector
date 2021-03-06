<?php
/**
 * Copyright (c) 2012-2016, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Factory\Device;

use BrowserDetector\Detector\Device\Desktop;
use BrowserDetector\Detector\Factory\FactoryInterface;
use BrowserDetector\Helper;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class DesktopFactory implements FactoryInterface
{
    /**
     * detects the device name from the given user agent
     *
     * @param string $useragent
     *
     * @return \UaResult\Device\DeviceInterface
     */
    public static function detect($useragent)
    {
        if ((new Helper\Windows($useragent))->isWindows()) {
            return new Desktop\WindowsDesktop($useragent);
        }

        if (preg_match('/Raspbian/', $useragent)) {
            return new Desktop\RaspberryPi($useragent);
        }

        if (preg_match('/debian/i', $useragent) && preg_match('/rpi/', $useragent)) {
            return new Desktop\RaspberryPi($useragent);
        }

        if ((new Helper\Linux($useragent))->isLinux()) {
            return new Desktop\LinuxDesktop($useragent);
        }

        if (preg_match('/iMac/', $useragent)) {
            return new Desktop\Imac($useragent);
        }

        if (preg_match('/macbookpro/i', $useragent)) {
            return new Desktop\MacBookPro($useragent);
        }

        if (preg_match('/macbookair/i', $useragent)) {
            return new Desktop\MacBookAir($useragent);
        }

        if (preg_match('/macbook/i', $useragent)) {
            return new Desktop\MacBook($useragent);
        }

        if (preg_match('/macmini/i', $useragent)) {
            return new Desktop\MacMini($useragent);
        }

        if (preg_match('/macpro/i', $useragent)) {
            return new Desktop\MacPro($useragent);
        }

        if (preg_match('/(powermac|power%20macintosh)/i', $useragent)) {
            return new Desktop\PowerMac($useragent);
        }

        if ((new Helper\Macintosh($useragent))->isMacintosh()) {
            return new Desktop\Macintosh($useragent);
        }

        if (preg_match('/eeepc/i', $useragent)) {
            return new Desktop\EeePc($useragent);
        }

        if (preg_match('/hp\-ux 9000/i', $useragent)) {
            return new Desktop\Hp9000($useragent);
        }

        if (preg_match('/Dillo/', $useragent)) {
            return new Desktop\LinuxDesktop($useragent);
        }

        return new Desktop\GeneralDesktop($useragent);
    }
}
