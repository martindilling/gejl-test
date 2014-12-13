<?php namespace Gejl\ValueObjects\String;

use Cocur\Slugify\Slugify;
use Gejl\ValueObjects\Exception\InvalidNativeArgumentException;
use Gejl\ValueObjects\ValueObjectInterface;
use ValueObjects\String\String;

class Slug extends String implements ValueObjectInterface
{
    /**
     * @var Slugify
     */
    private $slugger;

    protected $value;

    /**
     * Returns a String object given a PHP native string as parameter.
     *
     * @param string $value
     * @param bool $shouldGenerate
     */
    public function __construct($value, $shouldGenerate = false)
    {
        $this->slugger = new Slugify();

        if ($shouldGenerate) {
            $value = $this->generate($value);
        }

        if (!is_string($value) || !$this->isValid($value)) {
            throw new InvalidNativeArgumentException($value, array('string'));
        }
        $this->value = $value;
    }

    /**
     * Returns a String object given a PHP native string as parameter.
     *
     * @param String $string
     * @return Slug
     */
    public static function fromString(String $string)
    {
        return new static($string, true);
    }

    /**
     * Generate a slug from a string.
     *
     * @param string $string
     * @return string
     */
    private function generate($string)
    {
        return $this->slugger->slugify($string);
    }

    /**
     * Tells whether the slug is a valid slug
     *
     * @param string $slug
     * @return bool
     */
    private function isValid($slug)
    {
        if ($slug !== $this->generate($slug)) {
            return false;
        }

        return true;
    }
}
