<?php namespace Gejl\ValueObjects\Internationalization;

class LocaleTest extends \TestCase
{
    /**
     * @test
     * @expectedException Gejl\ValueObjects\Exception\InvalidNativeArgumentException
     */
    public function fail_with_no_locale()
    {
        new Locale('');
    }

    /** @test */
    public function can_get_language_name()
    {
        $localeEnglish = new Locale('en');
        $localeDanish = new Locale('da');
        
        $this->assertEquals('English', $localeEnglish->getLanguageName());
        $this->assertEquals('Danish', $localeDanish->getLanguageName());
    }

    /** @test */
    public function can_get_language_name_in_other_locales()
    {
        $localeEnglish = new Locale('en');
        $localeDanish = new Locale('da');
        
        $this->assertEquals('engelsk', $localeEnglish->getLanguageName(new Locale('da')));
        $this->assertEquals('dansk', $localeDanish->getLanguageName(new Locale('da')));
    }

    /** @test */
    public function can_get_language_code_in_iso_format()
    {
        $localeEnglish = new Locale('en');
        $localeDanish = new Locale('da');
        
        $this->assertEquals('en', $localeEnglish->getISO6391());
        $this->assertEquals('da', $localeDanish->getISO6391());
    }
}
