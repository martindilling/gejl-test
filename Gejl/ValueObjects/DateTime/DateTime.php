<?php namespace Gejl\ValueObjects\DateTime;

class DateTime extends \ValueObjects\DateTime\DateTime
{
    /**
     * Is the date in the future?
     * 
     * @return bool
     */
    public function isFuture()
    {
        return $this->toNativeDateTime() > new \DateTime('now');
    }

    /**
     * Is the date in the past?
     * 
     * @return bool
     */
    public function isPast()
    {
        return !$this->isFuture();
    }
    
    /**
     * Returns DateTime as string in ISO8601 with format "Y-m-d\TH:i:sO"
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNativeDateTime()->format(\DateTime::ISO8601);
    }
}
