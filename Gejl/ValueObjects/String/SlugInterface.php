<?php namespace Gejl\ValueObjects\String;

use Gejl\ValueObjects\ValueObjectInterface;

interface SlugInterface extends ValueObjectInterface
{
    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @param  string $value
     * @return Slug
     */
    public static function fromNative($value);

    /**
     * Returns a String object given a PHP native string as parameter.
     *
     * @param StringInterface $value
     * @return Slug
     */
    public static function fromString(StringInterface $value);

    /**
     * Tells whether the String is empty
     *
     * @return bool
     */
    public function isEmpty();
}
