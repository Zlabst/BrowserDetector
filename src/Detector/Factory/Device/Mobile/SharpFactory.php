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

namespace BrowserDetector\Detector\Factory\Device\Mobile;

use BrowserDetector\Detector\Device\Mobile\Sharp;
use BrowserDetector\Detector\Factory\FactoryInterface;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class SharpFactory implements FactoryInterface
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
        if (preg_match('/SHARP\-TQ\-GX30i/', $useragent)) {
            return new Sharp\SharpTqGx30i($useragent);
        }

        if (preg_match('/SH\-10D/', $useragent)) {
            return new Sharp\SharpSh10d($useragent);
        }

        if (preg_match('/SH\-01F/', $useragent)) {
            return new Sharp\SharpSH01F($useragent);
        }

        if (preg_match('/SH8128U/', $useragent)) {
            return new Sharp\SH8128U($useragent);
        }

        if (preg_match('/SH7228U/', $useragent)) {
            return new Sharp\SH7228U($useragent);
        }

        if (preg_match('/306SH/', $useragent)) {
            return new Sharp\SH306($useragent);
        }

        if (preg_match('/304SH/', $useragent)) {
            return new Sharp\SH304($useragent);
        }

        if (preg_match('/SH80F/', $useragent)) {
            return new Sharp\SH80F($useragent);
        }

        if (preg_match('/SH05C/', $useragent)) {
            return new Sharp\SH05C($useragent);
        }

        if (preg_match('/IS05/', $useragent)) {
            return new Sharp\IS05($useragent);
        }

        return new Sharp\Sharp($useragent);
    }
}
