<?php namespace Gejl\Blog;

use Gejl\ValueObjects\Internationalization\Locale;
use ValueObjects\Identity\UUID;
use ValueObjects\String\String;
use Gejl\ValueObjects\String\Slug;
use Gejl\ValueObjects\DateTime\DateTime;

abstract class AbstractArticle
{
    /**
     * @var \ValueObjects\Identity\UUID
     */
    protected $identity;

    /**
     * @var \Gejl\ValueObjects\Internationalization\Locale
     */
    protected $locale;

    /**
     * @var \ValueObjects\String\String
     */
    protected $title;

    /**
     * @var \Gejl\ValueObjects\String\Slug
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
     * @var string
     */
    protected $defaultLanguage = 'en';

    /**
     * @param string $identity
     * @param string $locale
     * @param string $title
     * @param string $slug
     * @param string $publishAt
     * @param string $body
     */
    function __construct($identity = null, $locale = null, $title = '', $slug = '', $publishAt = 'now', $body = '')
    {
        $this->setIdentity($identity);
        $this->setLocale($locale);
        $this->setTitle($title);
        $this->setSlug($slug);
        $this->setPublishAt($publishAt);
        $this->setBody($body);
    }

    /**
     * Create new article from an article instance.
     * 
     * @param AbstractArticle $article
     * @return static
     */
    public static function createFromArticle(AbstractArticle $article)
    {
        $new = new static();

        $new->setIdentity($article->getIdentity()->toNative());
        $new->setLocale($article->getLocale()->toNative());
        $new->setTitle($article->getTitle()->toNative());
        $new->setSlug($article->getSlug()->toNative());
        $new->setPublishAt($article->getPublishAt()->toISO8601());
        $new->setBody($article->getBody()->toNative());
        
        return $new;
    }

    /**
     * @param string $identity
     */
    public function setIdentity($identity)
    {
        if (is_null($identity)) {
            $identity = UUID::generateAsString();
        }
        $this->identity = UUID::fromNative($identity);
    }

    /**
     * @return \ValueObjects\Identity\UUID
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        if (is_null($locale)) {
            $locale = $this->defaultLanguage;
        }
        $this->locale = Locale::fromNative($locale);
    }

    /**
     * @return \Gejl\ValueObjects\Internationalization\Locale
     */
    public function getLocale()
    {
        return $this->locale;
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
