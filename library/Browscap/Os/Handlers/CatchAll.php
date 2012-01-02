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
 * @version    $id$
 */

use Browscap\Os\Handler as OsHandler;

/**
 * CatchAllUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

class CatchAll extends OsHandler
{
    /**
     * Final Interceptor: Intercept
     * Everything that has not been trapped by a previous handler
     *
     * @param string $userAgent
     * @return boolean always true
     */
    public function canHandle($userAgent)
    {
        return true;
    }
    
    /**
     * detects the browser name from the given user agent
     *
     * @param string $userAgent
     *
     * @return StdClass
     */
    public function detect($userAgent)
    {
        $class = new \StdClass();
        
        $detector = new \Browscap\Browscap();
        $detected = $detector->getBrowser($userAgent);
        
        $class->name     = $detected->Platform;
        $class->osFull   = $detected->Platform;
        $class->version  = 'unknown';
        $class->bits     = 0;
        
        $windows = array(
            'Win8', 'Win7', 'WinVista', 'WinXP', 'Win2000', 'Win98', 'Win95',
            'WinNT', 'Win31', 'WinME'
        );
        if (in_array($class->name, $windows)) {
            $osName = $class->name;
            
            if ('Win31' == $osName) {
                $class->version = '3.1';
            } else {
                $class->version = substr($osName, 3);
            }
            $class->name     = 'Windows';
            $class->osFull   = $class->name . ' ' . $class->version;
            
            if ('Win31' == $osName) {
                $class->bits = 16;
            } elseif ($this->utils->checkIfContainsAnyOf($userAgent, array('x64', 'WOW64', 'Win64'))) {
                $class->bits = 64;
            } else {
                $class->bits = 32;
            }
        }
        return $class;
    }
}