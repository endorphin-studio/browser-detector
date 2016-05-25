<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 2.0
 * @project browser-detector
 */

namespace EndorphinStudio;


class Detector
{
    /**
     * @return string Path to directory with xml data files
     */
    public function getPathToData()
    {
        return $this->PathToData;
    }

    /**
     * @return array Xml data object
     */
    public function getXmlData()
    {
        return $this->xmlData;
    }

    /**
     * @param string $PathToData
     */
    public function setPathToData($PathToData)
    {
        $this->PathToData = $PathToData;
    }

    /**
     * @param array $xmlData Xml data object
     */
    public function setXmlData($xmlData)
    {
        $this->xmlData = $xmlData;
    }
    /** @var  string Path to directory with xml data */
    private $PathToData;

    /** @var array Xml Data */
    private $xmlData;

    /**
     * Detector constructor.
     * @param string $pathToData Path to directory with xml data files
     */
    private function __construct($pathToData='auto')
    {
        if($pathToData == 'auto')
        {
            $this->setPathToData(str_replace('src','data',__DIR__).'/');
        }

        $xml = array('browser','device','os','robot');
        $xmlData = array();
        foreach($xml as $name)
        {
            $xmlData[$name] = simplexml_load_file($this->getPathToData().$name.'.xml');
        }
        $this->setXmlData($xmlData);
    }

    public static function Analyse($uaString='UA',$pathToData='auto')
    {
        $ua = $uaString;
        $pathXML = $pathToData;
        if($uaString == 'UA')
        {
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }

        $detector = new Detector($pathToData);
        $xml = $detector->getXmlData();
        $data = array();
        foreach($xml as $key => $item)
        {
            $data[$key] = self::analysePart($xml,$key,$ua);
        }

        $detectorResult = new DetectorResult();
        $detectorResult->uaString = $ua;

        foreach($data as $key => $result)
        {
            switch($key)
            {
                case 'os':
                    $os = new OS($result);
                    $os->Version = self::getVersion($result,$ua);
                    $detectorResult->OS = $os;
                    break;
                case 'device':
                    $device = new Device($result);
                    $detectorResult->Device = $device;
                    break;
                case 'browser':
                    $browser = new Browser($result);
                    $browser->Version = self::getVersion($result,$ua);
                    $detectorResult->Browser = $browser;
                    break;
            }
        }

        return $detectorResult;
    }

    /**
     * @param array $xmlData Xml data array
     * @param string $key Key in data array
     * @param string $uaString User agent
     * @return \SimpleXMLElement xml element
     */
    private static function analysePart($xmlData,$key,$uaString)
    {
        $data = $xmlData[$key]->data;
        foreach($data as $xmlItem)
        {
            $pattern = '/'.$xmlItem->pattern.'/';
            if(preg_match($pattern,$uaString))
            {
                return $xmlItem;
            }
        }
        return null;
    }

    /**
     * @param \SimpleXMLElement $xmlItem xmlItem
     * @param string $uaString User agent
     * @return string Version
     */
    private static function getVersion($xmlItem,$uaString)
    {
        $vPattern = $xmlItem->versionPattern;
        $version = @'/'.$vPattern.'(\/| )[\w-._]{1,15}/';
        $uaString = str_replace(' NT','',$uaString);
        if(preg_match($version,$uaString))
        {
            preg_match($version,$uaString,$v);
            @$version = $v[0];
            $version = preg_replace('/'.$vPattern.'/','',$version);
            $version = str_replace(';','',$version);
            $version = str_replace(' ','',$version);
            $version = str_replace('/','',$version);
            $version = str_replace('_','.',$version);

            if($xmlItem->id == 'Windows')
            {
                $version = self::getWindowsVersion($version);
            }

            return $version;
        }
        return null;
    }

    /**
     * @param $version Windows number version
     * @return string Windows version
     */
    private static function getWindowsVersion($version)
    {
        $versions = array(
            '5.1' => 'XP',
            '5.2' => 'Server 2003',
            '6.0' => 'Vista',
            '6.1' => '7',
            '6.2' => '8',
            '6.3' => '8.1',
            '6.4' => '10'
        );

        return $versions[$version];
    }

}