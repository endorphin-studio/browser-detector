<?php
/**
 * @author Sergey Nehaenko <sergey.nekhaenko@gmail.com>
 * @license GPL
 * @copyright Sergey Nehaenko &copy 2016
 * @version 1.0
 * @project browser-detector
 */

namespace EndorphinStudio\Tests;

use EndorphinStudio\Detector\Detector;

class Test
{
    public static function testUaList($TestObject,\SimpleXMLElement $XmlParams,\SimpleXMLElement $UAlist)
    {
        $uaList = array();
        foreach($UAlist->children() as $item)
        {
            $uaList[] = $item->__toString();
        }
        foreach($uaList as $ua)
        {
            $Object = null;
            foreach($XmlParams->children() as $Item) {
                $Property = $Item->Property->__toString();
                $ExpectedValue = $Item->Value->__toString();
                $params = explode('->', $Property);
                $Value = Detector::analyse($ua);
                $detector = $Value;
                $TextProperty = get_class($Value);
                foreach ($params as $parameter) {
                    if (!preg_match('/\(/', $parameter)) {
                        // property
                        $Value = $Value->$parameter;
                        $TextProperty = $TextProperty . '->' . $parameter;
                    } else {
                        $parameter = str_replace('(', '', $parameter);
                        $parameter = str_replace(')', '', $parameter);
                        $Value = $Value->$parameter();
                        $TextProperty = $TextProperty . '->' . $parameter . '()';
                    }
                }

                $TestObject->assertNotNull($Value);
                if ($ExpectedValue != 'true' && $ExpectedValue != 'false')
                    $TestObject->assertEquals($ExpectedValue, $Value);
                else {
                    if ($ExpectedValue == 'true')
                        $TestObject->assertTrue($Value, 'Object Property ' . $TextProperty . ' is no equal TRUE, UA:" '.$ua."\"\n\n".var_export($detector,true));
                    else
                        $TestObject->assertFalse($Value, 'Object Property ' . $TextProperty . ' is no equal FALSE, UA:'.$ua."\"\n\n".var_export($detector,true));
                }
            }
        }
    }
}