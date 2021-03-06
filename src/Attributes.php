<?php
namespace rOpenDev\PlatesExtension;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

/**
 * Transform an array in html tag attributes
 * PSR-2 Coding Style, PSR-4 Autoloading
 *
 * @author     Robin <contact@robin-d.fr> http://www.robin-d.fr/
 * @link       https://github.com/RobinDev/platesAttributes
 * @since      File available since Release 2014.12.15
 */
class Attributes implements ExtensionInterface
{
    /**
     * @param \League\Plates\Engine $engine
     */
    public function register(Engine $engine)
    {
        $engine->registerFunction('mergeAttr', [$this, 'mergeAttributes']);
        $engine->registerFunction('attr',      [$this, 'mapAttributes']);
    }

    /**
     * It will merge multiple attributes arrays without erase values
     *
     * @return array
     */
    public static function mergeAttributes()
    {
        $arrays = func_get_args();
        $result = [];

        foreach ($arrays as $array) {
            $result = self::mergeRecursive($result, $array);
        }

        return $result;
    }

    /**
     * @param  array $arr1
     * @param  array $arr2
     * @return array
     */
    protected static function mergeRecursive(array $arr1, array $arr2)
    {
        foreach ($arr2 as $key => $v) {
            if (is_array($v)) {
                $arr1[$key] = isset($arr1[$key]) ? self::mergeRecursive($arr1[$key], $v) : $v;
            }
            else {
                $arr1[$key] = isset($arr1[$key]) ? $arr1[$key].($arr1[$key] != $v ? ' '.$v : '') : $v;
            }
        }

        return $arr1;
    }

    /**
     * Render the attributes
     *
     * @param  array  $attributes
     * @return string
     */
    public static function mapAttributes(array $attributes)
    {
        $result = '';

        foreach ($attributes as $attribute => $value) {
            $e = strpos($value, ' ') !== false ? '"' : '';
            $result .= ' '.(is_int($attribute) ? $value : $attribute.'='.$e.str_replace('"', '&quot;',$value).$e);
        }

        return $result;
    }
}
