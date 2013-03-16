<?php
namespace Browscap\Detector\Os;

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

use \Browscap\Detector\OsHandler;
use \Browscap\Helper\Utils;
use \Browscap\Detector\MatcherInterface;
use \Browscap\Detector\MatcherInterface\OsInterface;
use \Browscap\Detector\BrowserHandler;
use \Browscap\Detector\EngineHandler;
use \Browscap\Detector\Version;

/**
 * MSIEAgentHandler
 *
 *
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
class Ios
    extends OsHandler
    implements MatcherInterface, OsInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $_properties = array(
        'wurflKey' => null, // not in wurfl
        
        // kind of device
        // 'is_wireless_device' => null,
        // 'is_tablet'          => null,
        // 'is_bot'             => null,
        // 'is_smarttv'         => null,
        // 'is_console'         => null,
        // 'ux_full_desktop'    => null,
        // 'is_transcoder'      => null,
        
        // device
        // 'model_name'                => null,
        // 'manufacturer_name'         => null,
        // 'brand_name'                => null,
        // 'model_extra_info'          => null,
        // 'marketing_name'            => null,
        // 'has_qwerty_keyboard'       => null,
        // 'pointing_method'           => null,
        // 'device_claims_web_support' => null,
        
        // browser
        // 'mobile_browser'         => null,
        // 'mobile_browser_version' => null,
        // 'mobile_browser_bits'    => null, // not in wurfl
        
        // os
        'device_os'              => 'iOS',
        'device_os_version'      => '',
        'device_os_bits'         => '', // not in wurfl
        'device_os_manufacturer' => 'Apple', // not in wurfl
        
        // engine
        // 'renderingengine_name'         => null, // not in wurfl
        // 'renderingengine_version'      => null, // not in wurfl
        // 'renderingengine_manufacturer' => null, // not in wurfl
    );
    
    /**
     * Returns true if this handler can handle the given $useragent
     *
     * @return bool
     */
    public function canHandle()
    {
        $ios = array(
            'IphoneOSX', 'iPhone OS', 'like Mac OS X', 'iPad', 'IPad', 'iPhone',
            'iPod', 'CPU OS', 'CPU iOS', 'IUC(U;iOS'
        );
        
        if (!$this->_utils->checkIfContains($ios)) {
            return false;
        }
        
        if ($this->_utils->checkIfContains('Darwin')) {
            return false;
        }
        
        return true;
    }
    
    /**
     * detects the browser version from the given user agent
     *
     * @param string $this->_useragent
     *
     * @return string
     */
    protected function _detectVersion()
    {
        $detector = new \Browscap\Detector\Version();
        $detector->setUserAgent($this->_useragent);
        
        $searches = array(
            'IphoneOSX', 'CPU OS', 'CPU iOS', 'CPU iPad OS', 'iPhone OS',
            'iPhone_OS', 'IUC\(U\;iOS'
        );
        
        $this->setCapability(
            'device_os_version', 
            $detector->detectVersion($searches)
        );
        
        $doMatch = preg_match('/CPU like Mac OS X/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->setCapability(
                'device_os_version', $detector->setVersion('1.0')
            );
        }
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 404;
    }
    
    /**
     * returns null, if the device does not have a specific Browser
     * returns the Browser Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function getBrowser()
    {
        $browsers = array(
            'Safari',
            'OperaMini',
            'Sleipnir',
            'DarwinBrowser',
            'Facebook',
            'Isource',
            'Chrome'
        );
        
        $browserPath = realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' 
            . DIRECTORY_SEPARATOR . 'Browser' 
            . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Mobile' 
            . DIRECTORY_SEPARATOR
        );
        $browserNs   = 'Browscap\\Browser\\Handlers\\Mobile';
        
        $chain = new \Browscap\Detector\Chain(false, $browsers, $browserPath, $browserNs);
        $chain->setDefaultHandler(new \Browscap\Detector\Browser\Mobile\Safari());
        $chain->setUseragent($this->_useragent);
        
        return $chain->detect();
    }
    
    /**
     * Returns the value of a given capability name
     * for the current device
     * 
     * @param string $capabilityName must be a valid capability name
     * @return string Capability value
     * @throws InvalidArgumentException
     */
    public function getCapability($capabilityName) 
    {
        $this->_checkCapability($capabilityName);
        
        switch ($capabilityName) {
            case 'model_extra_info':
                return $this->_properties['device_os_version']->getVersion(
                    Version::MAJORMINOR
                );
                break;
            default:
                return $this->_properties[$capabilityName];
                break;
        }
    }
}