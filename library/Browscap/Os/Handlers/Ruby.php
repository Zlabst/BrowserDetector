<?php
declare(ENCODING = 'utf-8');
namespace Browscap\Os\Handlers;

/**
 * Copyright(c) 2011 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version   SVN: $Id$
 */

use Browscap\Os\Handler as OsHandler;

/**
 * MSIEAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version   SVN: $Id$
 */
class Ruby extends OsHandler
{
    /**
     * @var string the detected platform
     */
    protected $_name = 'Ruby';
    
    /**
     * Returns true if this handler can handle the given $useragent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->_utils->checkIfContainsAnyOf($this->_useragent, array('Ruby'))) {
            return false;
        }
        
        $isNotReallyAWindows = array(
            'SymbianOS',
            'SymbOS',
            'Symbian',
            'Series 60'
        );
        
        if ($this->_utils->checkIfContainsAnyOf($this->_useragent, $isNotReallyAWindows)) {
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
        $doMatch = preg_match('/Ruby\/([\d\.p]+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->_version = $matches[1];
            return;
        }
        
        $this->_version = '';
    }
    
    public function getWeight()
    {
        return 8;
    }
}