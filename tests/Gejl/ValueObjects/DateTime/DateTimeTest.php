<?php namespace Gejl\ValueObjects\DateTime;

class DateTimeTest extends \TestCase
{
    /** @test */
    public function can_check_if_datetime_is_in_future()
    {
        $future = DateTime::fromNativeDateTime(new \DateTime('+1 day'));
        $past = DateTime::fromNativeDateTime(new \DateTime('-1 day'));
        
        $this->assertTrue($future->isFuture());
        $this->assertFalse($past->isFuture());
    }
    
    /** @test */
    public function can_check_if_datetime_is_in_past()
    {
        $future = DateTime::fromNativeDateTime(new \DateTime('+1 day'));
        $past = DateTime::fromNativeDateTime(new \DateTime('-1 day'));

        $this->assertTrue($past->isPast());
        $this->assertFalse($future->isPast());
    }

    /** @test */
    public function to_string_is_iso_standard()
    {
        $nativeDateTime = new \DateTime('2014-12-14');
        
        $dateTime = DateTime::fromNativeDateTime($nativeDateTime);
        
        $this->assertEquals($nativeDateTime->format(\DateTime::ISO8601), $dateTime->__toString());
    }
}
