<?php
namespace Browscap\Browser\Handlers\Bot;

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

use \Browscap\Browser\Handlers\General\Google;

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
class GoogleAppEngine extends Google
{
    /**
     * @var string the detected browser
     */
    protected $_browser = 'Google App-Engine';

    /**
     * @var string the detected manufacturer
     */
    protected $_manufacturer = 'Google';
    
    /**
     * Returns true if this handler can handle the given user agent
     *
     * @return bool
     */
    public function canHandle()
    {
        if ('' == $this->_useragent) {
            return false;
        }
        
        if (!$this->_utils->checkIfContains(array('AppEngine-Google', 'code.google.com/appengine'))) {
            return false;
        }
        
        return true;
    }
    
    /**
     * detects the browser version from the given user agent
     *
     * @return string
     */
    protected function _detectVersion()
    {
        $doMatch = preg_match('/appid: ([a-zA-Z0-9~ ]+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->_version = '(appid:' . $matches[1] . ')';
            return;
        }
        
        $this->_version = '';
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
     * returns TRUE if the browser supports Frames
     *
     * @return boolean
     */
    public function supportsFrames()
    {
        return true;
    }
    
    /**
     * returns TRUE if the browser supports IFrames
     *
     * @return boolean
     */
    public function supportsIframes()
    {
        return true;
    }
    
    /**
     * returns TRUE if the browser supports Tables
     *
     * @return boolean
     */
    public function supportsTables()
    {
        return true;
    }
    
    /**
     * returns TRUE if the browser supports Cookies
     *
     * @return boolean
     */
    public function supportsCookies()
    {
        return true;
    }
    
    /**
     * returns TRUE if the browser supports BackgroundSounds
     *
     * @return boolean
     */
    public function supportsBackgroundSounds()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser supports JavaScript
     *
     * @return boolean
     */
    public function supportsJavaScript()
    {
        return true;
    }
    
    /**
     * returns TRUE if the browser supports VBScript
     *
     * @return boolean
     */
    public function supportsVbScript()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser supports Java Applets
     *
     * @return boolean
     */
    public function supportsJavaApplets()
    {
        return true;
    }
    
    /**
     * returns TRUE if the browser supports ActiveX Controls
     *
     * @return boolean
     */
    public function supportsActivexControls()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser should be banned
     *
     * @return boolean
     */
    public function isBanned()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser is a Syndication Reader
     *
     * @return boolean
     */
    public function isSyndicationReader()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser supports VBScript
     *
     * @return boolean
     */
    public function isCrawler()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser is a Syndication Reader
     *
     * @return boolean
     */
    public function isTranscoder()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser supports RSS Feeds
     *
     * @return boolean
     */
    public function isRssSupported()
    {
        return false;
    }
    
    /**
     * returns TRUE if the browser supports PDF documents
     *
     * @return boolean
     */
    public function isPdfSupported()
    {
        return true;
    }
}