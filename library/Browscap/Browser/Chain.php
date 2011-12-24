<?php
declare(ENCODING = 'utf-8');
namespace Browscap\Browser;

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
 * @package    WURFL
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

/**
 * Utility class which holds the detection functions
 */
use \Browscap\Utils;

/**
 * the browser database model
 */
use \Browscap\Model\Browsers;

/**
 * Manages the creation and instatiation of all User Agent Handlers and Normalizers and provides a factory for creating User Agent Handler Chains
 * @package    WURFL
 * @see WURFL_UserAgentHandlerChain
 */
class Chain
{

    /**
     * @var \
     */
    private $_chain = null;
    
    /**
     * @var Browscap\Utils
     */
    protected $utils = null;
    
    /**
     * @var Browscap\Browser\Handler
     */
    protected $handler = null;
    
    private $_log = null;

    /**
     * Initializes the factory with an instance of all possible Handler objects from the given $context
     * @param WURFL_Context $context
     */
    public function __construct()
    {
        // the utility classes
        $this->utils  = new Utils();
        $this->_chain = new \SplPriorityQueue();
        
        // get all Browsers
        $browserModel = new Browsers();
        $allBrowsers  = $browserModel->getAll();
        
        foreach ($allBrowsers as $singleBrowser) {
            $this->_chain->insert($singleBrowser->name, $singleBrowser->count);
        }
        
        $this->_log = \Zend\Registry::get('log');
    }
    
    /**
     * detect the user agent
     *
     * @param string $userAgent The user agent
     *
     * @return string
     */
    public function detect($userAgent)
    {
        $browser = new \StdClass();
        $browser->browser    = 'unknown';
        $browser->version    = 0.0;
        $browser->bits       = 0;
        $browser->idBrowsers = null;
        
        $browserModel = new Browsers();
        
        if ($this->_chain->count()) {
            $this->_chain->top();
            
            while ($this->_chain->valid()) {
                $class = ltrim($this->_chain->current(), '\\');
                $class = strtolower(str_replace(array('-', '_', ' ', '/', '\\'), ' ', $class));
                $class = preg_replace('/[^a-zA-Z ]/', '', $class);
                $class = str_replace(' ', '', ucwords($class));
                
                $className = '\\' . __NAMESPACE__ . '\\Handlers\\' . $class;
                try {
                    $handler = new $className();
                } catch (\Exception $e) {
                    echo "Class '$className' not found \n";
                    
                    $this->_log->err($e);
                    
                    $this->_chain->next();
                    continue;
                }
                
                if ($handler->canHandle($userAgent)) {
                    try {
                        $browser = $handler->detect($userAgent);
                        
                        $browser->idBrowsers = $browserModel->searchByBrowser($browser->browser, $browser->version, $browser->bits)->idBrowsers;
                        
                        return $browser;
                    } catch (\UnexpectedValueException $e) {
                        // do nothing
                        $this->_log->err($e);
                        
                        $this->_chain->next();
                        continue;
                    }
                }
                
                $this->_chain->next();
            }
        }
        
        //if not deteceted yet, use ini file as fallback
        $handler = new Handlers\CatchAll();
        if ($handler->canHandle($userAgent)) {
            $browser = $handler->detect($userAgent);
            echo print_r($browser, true);
            $searchresult = $browserModel->searchByBrowser($browser->browser, $browser->version, $browser->bits);
            
            if ($searchresult) {
                $browser->idBrowsers = $searchresult->idBrowsers;
            }
        }
        
        return $browser;
    }
}
