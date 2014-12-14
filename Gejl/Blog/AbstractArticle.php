<?php namespace Gejl\Blog;

use ValueObjects\String\String;
use Gejl\ValueObjects\String\Slug;
use Gejl\ValueObjects\DateTime\DateTime;

abstract class AbstractArticle
{
    /**
     * @var \ValueObjects\String\String
     */
    protected $title;
    
    /**
     * @var \ValueObjects\String\String
     */
    protected $slug;
    
    /**
     * @var \Gejl\ValueObjects\DateTime\DateTime
     */
    protected $publishAt;
    
    /**
     * @var \ValueObjects\String\String
     */
    protected $body;

    /**
     * @param string $title
     * @param string $slug
     * @param string $publishAt
     * @param string $body
     */
    function __construct($title = '', $slug = '', $publishAt = 'now', $body = '')
    {
        $this->title     = String::fromNative($title);
        $this->slug      = Slug::fromNative($slug);
        $this->publishAt = DateTime::fromNativeDateTime(new \DateTime($publishAt));
        $this->body      = String::fromNative($body);
    }

    /**
     * Create new article from an article instance.
     * 
     * @param AbstractArticle $article
     * @return static
     */
    public static function createFromArticle(AbstractArticle $article)
    {
        return new static(
            $article->getTitle()->toNative(),
            $article->getSlug()->toNative(),
            $article->getPublishAt()->toISO8601(),
            $article->getBody()->toNative()
        );
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = String::fromNative($title);
    }

    /**
     * @return \ValueObjects\String\String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = Slug::fromNative($slug);
    }

    /**
     * @return \ValueObjects\String\String
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $publishAt
     */
    public function setPublishAt($publishAt)
    {
        $this->publishAt = DateTime::fromNativeDateTime(new \DateTime($publishAt));
    }

    /**
     * @return \Gejl\ValueObjects\DateTime\DateTime
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = String::fromNative($body);
    }

    /**
     * @return \ValueObjects\String\String
     */
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
