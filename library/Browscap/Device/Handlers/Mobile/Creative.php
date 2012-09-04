<?php
namespace Browscap\Device\Handlers\Mobile;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    SVN: $Id$
 */

use Browscap\Device\Handlers\GeneralMobile;

/**
 * CatchAllUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    SVN: $Id$
 */
class Creative extends GeneralMobile
{
    /**
     * @var string the detected device
     */
    protected $_device = 'general Creative Device';

    /**
     * @var string the detected manufacturer
     */
    protected $_manufacturer = 'Creative';
    
    /**
     * Final Interceptor: Intercept
     * Everything that has not been trapped by a previous handler
     *
     * @param string $this->_useragent
     * @return boolean always true
     */
    public function canHandle()
    {
        if ('' == $this->_useragent) {
            return false;
        }
        
        $creativePhones = array('Creative', 'ZiiLABS');
        
        if ($this->_utils->checkIfContains($creativePhones)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * detects the device name from the given user agent
     *
     * @param string $userAgent
     *
     * @return StdClass
     */
    public function detect()
    {
        $chain = new \Browscap\Device\Chain(
            true, 
            null, 
            __DIR__ . DIRECTORY_SEPARATOR . 'Creative' . DIRECTORY_SEPARATOR, 
            __NAMESPACE__ . '\\Creative'
        );
        $chain->setDefaultHandler($this);
        
        return $chain->detect($this->_useragent);
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return parent::getWeight() + 1;
    }
    
    /**
     * returns TRUE if the device has a specific Operating System
     *
     * @return boolean
     */
    public function hasOs()
    {
        return true;
    }
    
    /**
     * returns null, if the device does not have a specific Operating System
     * returns the OS Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function getOs()
    {
        $handler = new \Browscap\Os\Handlers\Android();
        $handler->setLogger($this->_logger);
        $handler->setUseragent($this->_useragent);
        
        return $handler->detect();
    }
    
    /**
     * returns TRUE if the device has a specific Browser
     *
     * @return boolean
     */
    public function hasBrowser()
    {
        return true;
    }
    
    /**
     * returns null, if the device does not have a specific Browser
     * returns the Browser Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function getBrowser()
    {
        $browserPath = realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' 
            . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Browser' 
            . DIRECTORY_SEPARATOR . 'Handlers' . DIRECTORY_SEPARATOR . 'Mobile' 
            . DIRECTORY_SEPARATOR
        );
        $browserNs   = 'Browscap\\Browser\\Handlers\\Mobile';
        
        $chain = new \Browscap\Browser\Chain(true, null, $browserPath, $browserNs);
        $chain->setDefaultHandler(new \Browscap\Browser\Handlers\Unknown());
        
        if ($this->_cache instanceof \Zend\Cache\Frontend\Core) {
            $chain->setCache($this->_cache);
        }
        
        return $chain->detect($this->_useragent);
    }
}