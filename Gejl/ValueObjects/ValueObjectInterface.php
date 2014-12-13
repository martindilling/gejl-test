<?php namespace Gejl\ValueObjects;

interface ValueObjectInterface extends \ValueObjects\ValueObjectInterface
{
    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative();
}
