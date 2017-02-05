<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 3.0.0
 * @project browser-detector
 */

namespace EndorphinStudio\Detector;

class Detector
{
    /** @var array Xml Data */
    private static $_xmlData;
    public static $isInitialized = false;

    private static function initialize($pathToData = 'auto')
    {
        if ($pathToData == 'auto')
        {
            $pathToData = str_replace('src', 'data', __DIR__) . '/';
        }

        if (self::$_xmlData === null)
        {
            $xml = array('Robot', 'Browser', 'Device', 'OS');
            $xmlData = array();
            foreach ($xml as $name) {
                $xmlData[$name] = simplexml_load_file($pathToData . strtolower($name) . '.xml');
            }
            self::$_xmlData = $xmlData;
            self::$isInitialized = true;
        }
    }

    public static function analyse($uaString='UA')
    {
        $ua = $uaString;
        if($uaString == 'UA')
        {
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }

        if(!self::$isInitialized)
            self::initialize();
        $xml = self::$_xmlData;

        $detectorResult = new DetectorResult();
        $detectorResult->uaString = $ua;
        $ns = '\\EndorphinStudio\\Detector\\';

        foreach($xml as $key => $item)
        {
            $data = self::analysePart($xml,$key,$ua);
            $classname = $ns.$key;
            if($data !== null)
            {
                $object = new $classname($data);
                if($key == 'OS' || $key == 'Browser')
                {
                    $object->setVersion(self::getVersion($data, $ua));
                }
                if($key == 'Robot')
                {
                    if($object->getName() != D_NA)
                    {
                        $detectorResult->isBot = true;
                    }
                }
            }
            else
            {
                $object = $classname::initEmpty();
            }
            $detectorResult->$key = $object;
        }

        $detectorResult = self::checkRules($detectorResult);
        $detectorResult = self::checkModelName($detectorResult);

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
    private static function getVersion(\SimpleXMLElement $xmlItem,$uaString)
    {
        if($xmlItem !== null)
        {
            foreach($xmlItem->children() as $node)
            {
                if($node->getName() == 'versionPattern')
                {
                    $vPattern = $node->__toString();
                    $version = '/' . $vPattern . '(\/| )[\w-._]{1,15}/';
                    $uaString = str_replace(' NT', '', $uaString);
                    if (preg_match($version, $uaString)) {
                        preg_match($version, $uaString, $v);
                        $version = $v[0];
                        $version = preg_replace('/' . $vPattern . '/', '', $version);
                        $version = str_replace(';', '', $version);
                        $version = str_replace(' ', '', $version);
                        $version = str_replace('/', '', $version);
                        $version = str_replace('_', '.', $version);

                        if ($xmlItem->id == 'Windows') {
                            $version = self::getWindowsVersion($version);
                        }

                        return $version;
                    }
                }
            }
        }
        return D_NA;
    }

    /**
     * @param $version Windows number version
     * @return string Windows version
     */
    private static function getWindowsVersion($version)
    {
        $versions = array(
            '95' => '95',
            '3.1' => '3.1',
            '3.5' => '3.5',
            '3.51' => '3.51',
            '4.0' => '4.0',
            '2000' => '2000',
            '5.0' => '2000',
            '5.1' => 'XP',
            '5.2' => 'Server 2003',
            '6.0' => 'Vista',
            '6.1' => '7',
            '6.2' => '8',
            '6.3' => '8.1',
            '6.4' => '10',
            '10.0' => '10'
        );

        if(array_key_exists(strval($version),$versions))
            return $versions[strval($version)];
        else
            return D_NA;
    }

    /**
     * @param DetectorResult $result Detector result
     * @return DetectorResult Final result
     */
    private static function checkRules(DetectorResult $result)
    {
        $Rules = DetectorRule::loadRulesFromFile();
        foreach($Rules as $rule)
        {
            $objectType = $rule->getObjectType();
            $objectProperty = $rule->getObjectProperty();
            $targetType = $rule->getTargetType();
            $targetValue = $rule->isTargetValue();
            $func = 'get'.$objectProperty;
            if($result->$objectType !== null)
            {
                if ($result->$objectType->$func() == $rule->getObjectPropertyValue()) {
                    $result->$targetType = $targetValue;
                    break;
                }
            }
        }
        return $result;
    }

    private static function checkModelName(DetectorResult $result)
    {
        $models = DeviceModel::loadFromFile();
        foreach($models as $model)
        {
            if($model->getDeviceName() === $result->Device->getName())
            {
                $pattern = '/'.$model->getPattern().'/';
                preg_match($pattern,$result->uaString,$match);
                $result->Device->setModelName($match[1]);
            }
        }
        return $result;
    }
}
define('D_NA','N\A');
