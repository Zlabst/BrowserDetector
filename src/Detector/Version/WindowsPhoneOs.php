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

namespace BrowserDetector\Detector\Version;

use BrowserDetector\Version\VersionFactory;
use UaHelper\Utils;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class WindowsPhoneOs
{
    /**
     * returns the version of the operating system/platform
     *
     * @param string $useragent
     *
     * @return \BrowserDetector\Version\Version
     */
    public static function detectVersion($useragent)
    {
        $utils = new Utils();
        $utils->setUserAgent($useragent);

        if ($utils->checkIfContains(['XBLWP7', 'ZuneWP7'])) {
            return VersionFactory::set('7.5.0');
        }

        if ($utils->checkIfContains('wds 8.10')) {
            return VersionFactory::set('8.1.0');
        }

        if ($utils->checkIfContains('WPDesktop')) {
            if ($utils->checkIfContains('Windows NT 6.3')) {
                return VersionFactory::set('8.1.0');
            }

            if ($utils->checkIfContains('Windows NT 6.2')) {
                return VersionFactory::set('8.0.0');
            }

            return VersionFactory::set('0.0.0');
        }

        $searches = ['Windows Phone OS', 'Windows Phone', 'wds', 'Windows Mobile', 'Windows NT'];

        return VersionFactory::detectVersion($useragent, $searches);
    }
}
