<?php namespace Gejl\ValueObjects\String;

use ValueObjects\String\String;

class SlugTest extends \TestCase
{
    /** @test */
    public function can_create_from_native()
    {
        $slug            = Slug::fromNative('foo');
        $constructedSlug = new Slug('foo');

        $this->assertTrue($slug->sameValueAs($constructedSlug));
    }

    /** @test */
    public function can_output_to_native()
    {
        $slug = new Slug('foo');

        $this->assertEquals('foo', $slug->toNative());
    }

    /** @test */
    public function can_check_if_same_value_as()
    {
        $foo1 = new Slug('foo');
        $foo2 = new Slug('foo');
        $bar  = new Slug('bar');
        $mock = $this->getMock('Gejl\ValueObjects\ValueObjectInterface');

        $this->assertTrue($foo1->sameValueAs($foo2));
        $this->assertTrue($foo2->sameValueAs($foo1));
        $this->assertFalse($foo1->sameValueAs($bar));
        $this->assertFalse($foo1->sameValueAs($mock));
    }

    /**
     * @test
     * @expectedException Gejl\ValueObjects\Exception\InvalidNativeArgumentException
     */
    public function fails_with_other_than_a_string()
    {
        new Slug(12);
    }

    /**
     * @test
     * @expectedException Gejl\ValueObjects\Exception\InvalidNativeArgumentException
     */
    public function fails_with_invalid_slug()
    {
        new Slug('string with spaces');
    }

    /** @test */
    public function can_see_if_is_empty()
    {
        $slug = new Slug('');

        $this->assertTrue($slug->isEmpty());
    }

    /** @test */
    public function can_cast_to_string()
    {
        $foo = new Slug('foo');

        $this->assertEquals('foo', $foo->__toString());
    }

    /** @test */
    public function can_generate_from_string()
    {
        $slug = Slug::fromString(new String('Some string here!? Does it work?'));

        $this->assertEquals('some-string-here-does-it-work', $slug->__toString());
    }
}
