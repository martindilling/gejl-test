<?php namespace Gejl\Blog;

use ValueObjects\String\String;
use Gejl\ValueObjects\String\Slug;
use Gejl\ValueObjects\DateTime\DateTime;

abstract class AbstractArticle
{
    protected $title;
    protected $slug;
    protected $publishAt;
    protected $body;

    function __construct($title = '', $slug = '', $publishAt = 'now', $body = '')
    {
        $this->title     = String::fromNative($title);
        $this->slug      = Slug::fromNative($slug);
        $this->publishAt = DateTime::fromNativeDateTime(new \DateTime($publishAt));
        $this->body      = String::fromNative($body);
    }

    public function setTitle($title)
    {
        $this->title = String::fromNative($title);
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setSlug($slug)
    {
        $this->slug = Slug::fromNative($slug);
    }
    public function getSlug()
    {
        return $this->slug;
    }

    public function setPublishAt($publishAt)
    {
        $this->publishAt = DateTime::fromNativeDateTime(new \DateTime($publishAt));
    }
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    public function setBody($body)
    {
        $this->body = String::fromNative($body);
    }
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Is the article public.
     * Determined by draft status and publish at date
     * 
     * @return bool
     */
    public function isPublic()
    {
        return !$this->isDraft() && $this->getPublishAt()->isPast();
    }
    
    /**
     * Is the article a draft.
     * 
     * @return bool
     */
    abstract public function isDraft();
}
