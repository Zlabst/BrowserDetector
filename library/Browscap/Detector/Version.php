<?php
namespace Browscap\Detector;

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
 * WURFL_Handlers_Handler is the base class that combines the classification of
 * the user agents and the matching process.
 *
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
final class Version
{
    /**
     * @var integer
     */
    const MAJORONLY   = 1;
    
    /**
     * @var integer
     */
    const MAJORMINOR  = 2;
    
    /**
     * @var integer
     */
    const FULLVERSION = 3;
    
    /**
     * @var integer
     */
    const MINORONLY   = 4;
    
    /**
     * @var string the user agent to handle
     */
    private $_useragent = null;
    
    /**
     * @var string the detected complete version
     */
    private $_version = null;
    
    /**
     * @var string the detected major version
     */
    private $_major = null;
    
    /**
     * @var string the detected minor version
     */
    private $_minor = null;
    
    /**
     * @var string the detected micro version
     */
    private $_micro = null;
    
    /**
     * @var string the default version
     */
    private $_default = '';
    
    /**
     * @var boolean a Flag to tell that the minor and the micro versions should
     *              be ignored
     */
    private $_ignoreMinor = false;
    
    /**
     * @var boolean a Flag to tell that the micro version should be ignored
     */
    private $_ignoreMicro = false;
    
    /**
     * sets the user agent to be handled
     *
     * @return Version
     */
    public function setUserAgent($userAgent)
    {
        $this->_useragent = $userAgent;
        
        return $this;
    }
    
    /**
     * returns the detected version
     *
     * @param string $mode
     *
     * @return string
     * @throws \UnexpectedValueException
     */
    public function getVersion($mode = self::MAJORMINOR)
    {
        if (null === $this->_version) {
            if (null === $this->_useragent) {
                throw new \UnexpectedValueException(
                    'You have to set the useragent before calling this function'
                );
            }
            
            $this->detectVersion();
        }
        
        switch ($mode) {
            case self::MAJORONLY:
                return ($this->_major ? $this->_major : '');
                break;
            case self::MINORONLY:
                if ($this->_ignoreMinor) {
                    return '';
                } else {
                    return ($this->_minor ? $this->_minor : '');
                }
                break;
            case self::MAJORMINOR:
                if ($this->_ignoreMinor) {
                    return ($this->_major ? $this->_major : '');
                } else {
                    $version = $this->_major . '.' . $this->_minor;
                    
                    if ('0.0' == $version) {
                        return '';
                    }
                    
                    return $version;
                }
                break;
            default:
                if ($this->_ignoreMinor) {
                    return ($this->_major ? $this->_major : '');
                } elseif ($this->_ignoreMicro) {
                    $version = $this->_major . '.' . $this->_minor;
                    
                    if ('0.0' == $version) {
                        return '';
                    }
                    
                    return $version;
                } else {
                    $version = $this->_major . '.' . $this->_minor . '.' 
                        . $this->_micro;
                    
                    if ('0.0.0' == $version) {
                        return '';
                    }
                    
                    return $version;
                }
                break;
        }
    }
    
    /**
     * detects the bit count by this browser from the given user agent
     *
     * @param string|array $searches
     *
     * @return Version
     * @throws \UnexpectedValueException
     */
    public function detectVersion($searches = null)
    {
        if (!is_array($searches) && !is_string($searches)) {
            throw new \UnexpectedValueException(
                'a string or an array of strings is expected as parameter'
            );
        }
        
        if (!is_array($searches)) {
            $searches = array($searches);
        }
        
        $modifiers = array(
            array('\/', ''),
            array('(', ')'),
            array(' ', ''),
            array('', '')
        );
        
        $version = $this->_default;
        $found   = false;
        
        foreach ($searches as $search) {
            if (!is_string($search)) {
                continue;
            }
            
            if (false !== strpos($search, '%')) {
                $search = urldecode($search);
            }
            
            foreach ($modifiers as $modifier) {
                $compareString = '/' . $search . $modifier[0] . '([\d\.\_ab]+)'
                    . $modifier[1] . '/';
                
                $doMatch = preg_match(
                    $compareString, $this->_useragent, $matches
                );
            
                if ($doMatch) {
                    $version = $matches[1];
                    $found   = true;
                    break;
                }
            }
            
            if ($found) {
                break;
            }
        }
        
        return $this->setVersion($version);
    }
    
    /**
     * sets the detected version
     *
     * @param string $version
     *
     * @return Version
     * @throws \UnexpectedValueException
     */
    public function setVersion($version)
    {
        $version  = ltrim(str_replace('_', '.', $version), '0');
        $splitted = explode('.', $version, 3);
        
        $this->_major = (!empty($splitted[0]) ? $splitted[0] : '0');
        $this->_minor = (!empty($splitted[1]) ? $splitted[1] : '0');
        $this->_micro = (!empty($splitted[2]) ? $splitted[2] : '0');
        
        $this->_version = $version;
        
        return $this;
    }
    
    /**
     * sets the default version, which is used, if no version could be detected
     *
     * @param string $version
     *
     * @return Version
     * @throws \UnexpectedValueException
     */
    public function setDefaulVersion($version)
    {
        if (!is_string($version)) {
            throw new \UnexpectedValueException(
                'the default version needs to be a string'
            );
        }
        
        $this->_default = $version;
    }
    
    /**
     * sets the flag to ignore the minor and the micro versions
     *
     * @param boolean $ignore
     *
     * @return Version
     */
    public function ignoreMinorVersion($ignore)
    {
        $this->_ignoreMinor = ($ignore ? true : false);
    }
    
    /**
     * sets the flag to ignore the micro version
     *
     * @param boolean $ignore
     *
     * @return Version
     */
    public function ignoreMicroVersion($ignore)
    {
        $this->_ignoreMicro = ($ignore ? true : false);
    }
    
    public function __toString()
    {
        try {
            return $this->getVersion(self::FULLVERSION);
        } catch (\Exception $e) {
            return '';
        }
    }
    
    /**
     * detects if the version is makred as Alpha
     *
     * @return boolean
     */
    public function isAlpha()
    {
        return (false !== strpos($this->_version, 'a'));
    }
    
    /**
     * detects if the version is makred as Beta
     *
     * @return boolean
     */
    public function isBeta()
    {
        return (false !== strpos($this->_version, 'b'));
    }
}