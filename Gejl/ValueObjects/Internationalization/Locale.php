<?php namespace Gejl\ValueObjects\Internationalization;

use Gejl\ValueObjects\Exception\InvalidNativeArgumentException;
use Gejl\ValueObjects\ValueObjectInterface;
use ValueObjects\String\String;

class Locale extends String implements ValueObjectInterface
{
    /**
     * Returns a String object given a PHP native string as parameter.
     * 
     * @param string $iso6391
     */
    public function __construct($iso6391)
    {
        if (empty($iso6391) || !is_string($iso6391)) {
            throw new InvalidNativeArgumentException($iso6391, array('string'));
        }

        if (!LocaleList::isValid($iso6391)) {
            throw new InvalidNativeArgumentException($iso6391, array('valid locale'));
        }

        $this->value = $iso6391;
    }

    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getISO6391();
    }

    /**
     * Get the ISO 639-1 language code.
     * 
     * @return string
     */
    public function getISO6391()
    {
        return $this->toNative();
    }

    /**
     * Get the language name.
     *
     * @param Locale $language
     * @return string
     */
    public function getLanguageName(Locale $language = null)
    {
        return \Locale::getDisplayLanguage($this->getISO6391(), $language ?: 'en');
    }
}
