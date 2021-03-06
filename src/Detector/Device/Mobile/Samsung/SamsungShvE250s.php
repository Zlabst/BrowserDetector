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

namespace BrowserDetector\Detector\Device\Mobile\Samsung;

use BrowserDetector\Detector\Factory\CompanyFactory;
use UaResult\Device\Device;
use BrowserDetector\Detector\Os;
use UaDeviceType;
use BrowserDetector\Matcher\Device\DeviceHasSpecificPlatformInterface;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class SamsungShvE250s extends Device implements DeviceHasSpecificPlatformInterface
{
    /**
     * the class constructor
     *
     * @param string $useragent
     */
    public function __construct($useragent)
    {
        $this->useragent         = $useragent;
        $this->deviceName        = 'SHV-E250S';
        $this->marketingName     = 'Galaxy Note II LTE (Korea SK Telecom)';
        $this->version           = null;
        $this->manufacturer      = CompanyFactory::get('Samsung')->getName();
        $this->brand             = CompanyFactory::get('Samsung')->getBrandName();
        $this->pointingMethod    = 'touchscreen';
        $this->resolutionWidth   = 720;
        $this->resolutionHeight  = 1280;
        $this->dualOrientation   = true;
        $this->colors            = 65536;
        $this->smsSupport        = true;
        $this->nfcSupport        = true;
        $this->hasQwertyKeyboard = false;
        $this->type              = new UaDeviceType\MobilePhone();
    }

    /**
     * returns the OS Handler
     *
     * @return \UaResult\Os\OsInterface|null
     */
    public function detectOs()
    {
        return new Os\AndroidOs($this->useragent);
    }
}
