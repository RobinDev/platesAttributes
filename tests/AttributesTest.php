<?php

namespace rOpenDev\PlatesExtension\Test;

class AttributesTest extends \PHPUnit_Framework_TestCase
{
    /** @var \League\Plates\Engine */
    protected $tmpl;
    /** @var \rOpenDev\PlatesExtension\Attributes */
    protected $attributes;

    public function __construct()
    {
        $this->attributes = new \rOpenDev\PlatesExtension\Attributes();

        $this->tmpl = new \League\Plates\Engine();
        $this->tmpl->loadExtension($this->attributes);
    }

    public function testMerging()
    {
        $arr1     = ['class' => 'main'];
        $arr2     = ['class' => 'content'];
        $expected = ['class' => 'main content'];

        $result   = $this->attributes->mergeAttributes($arr1, $arr2);

        $this->assertSame($expected, $result);
    }

    public function testRendering()
    {
        $attr     = ['class' => 'main content'];
        $expected = ' class="main content"';

        $result = $this->attributes->mapAttributes($attr);

        $this->assertSame($expected, $result);
    }
}
