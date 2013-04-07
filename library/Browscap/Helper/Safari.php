<?php
namespace Browscap\Helper;

/**
 * PHP version 5.3
 *
 * LICENSE:
 *
 * Copyright (c) 2013, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, 
 *   this list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice, 
 *   this list of conditions and the following disclaimer in the documentation 
 *   and/or other materials provided with the distribution.
 * * Neither the name of the authors nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
/**
 * WURFL user agent hander utilities
 * @package   Browscap
 */
final class Safari
{
    /**
     * @var string the user agent to handle
     */
    private $_useragent = '';
    
    /**
     * @var \Browscap\Helper\Utils the helper class
     */
    private $_utils = null;
    
    /**
     * Class Constructor
     *
     * @return DeviceHandler
     */
    public function __construct()
    {
        $this->_utils = new Utils();
    }
    
    /**
     * sets the user agent to be handled
     *
     * @return void
     */
    public function setUserAgent($userAgent)
    {
        $this->_useragent = $userAgent;
        $this->_utils->setUserAgent($userAgent);
        
        return $this;
    }
    
    public function isSafari()
    {
        if (!$this->_utils->checkIfStartsWith('Mozilla/')
            && !$this->_utils->checkIfStartsWith('Safari')
            && !$this->_utils->checkIfStartsWith('MobileSafari')
        ) {
            return false;
        }
        
        if (!$this->_utils->checkIfContains(array('Safari', 'AppleWebKit', 'CFNetwork'))) {
            return false;
        }
        
        $isNotReallyAnSafari = array(
            // using also the KHTML rendering engine
            '1Password',
            'AdobeAIR',
            'Arora',
            'BlackBerry',
            'BrowserNG',
            'Chrome',
            'Chromium',
            'Dolfin',
            'Dreamweaver',
            'Epiphany',
            'Flock',
            'Galeon',
            'Google Earth',
            'iCab',
            'Iron',
            'konqueror',
            'Lunascape',
            'Maemo',
            'Midori',
            'MQQBrowser',
            'NokiaBrowser',
            'OmniWeb',
            'PaleMoon',
            'PhantomJS',
            'Qt',
            'rekonq',
            'Rockmelt',
            'Silk',
            'Shiira',
            'WebBrowser',
            'WebClip',
            'WeTab',
            'wOSBrowser',
            //mobile Version
            //'Mobile',
            'Tablet',
            'Android',
            // Fakes
            'Mac; Mac OS '
        );
        
        if ($this->_utils->checkIfContains($isNotReallyAnSafari)) {
            return false;
        }
        
        return true;
    }
    
    public function isMobileAsSafari()
    {
        if (!$this->isSafari()) {
            return false;
        }
        
        $mobileDeviceHelper = new MobileDevice();
        $mobileDeviceHelper->setUserAgent($this->_useragent);
        
        if (!$mobileDeviceHelper->isMobileBrowser()) {
            return false;
        }
        
        if ($this->_utils->checkIfContains(array('PLAYSTATION', 'Browser/AppleWebKit', 'CFNetwork', 'BlackBerry; U; BlackBerry'))) {
            return false;
        }
        
        return true;
    }
    
    /**
     * maps different Safari Versions to a normalized format
     *
     * @return string
     */
    public function mapSafariVersions($detectedVersion)
    {
        if ($detectedVersion >= 8500) {
            return '6.0';
        }
        
        if ($detectedVersion >= 7500) {
            return '5.1';
        }
        
        if ($detectedVersion >= 6500) {
            return '5.0';
        }
        
        if ($detectedVersion >= 750) {
            return '5.1';
        }
        
        if ($detectedVersion >= 650) {
            return '5.0';
        }
        
        if ($detectedVersion >= 500) {
            return '4.0';
        }
        
        $regularVersions = array(
            '3.0', '3.1', '3.2', '4.0', '4.1', '5.0', '5.1', '5.2', '6.0'
        );
        
        if (in_array(substr($detectedVersion, 0, 3), $regularVersions)) {
            return $detectedVersion;
        }
        
        return '';
    }
}