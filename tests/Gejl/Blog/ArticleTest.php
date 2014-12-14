<?php namespace Gejl\Blog;

use Gejl\ValueObjects\DateTime\DateTime;
use Gejl\ValueObjects\Internationalization\Locale;
use Gejl\ValueObjects\String\Slug;
use ValueObjects\Identity\UUID;
use ValueObjects\String\String;

class ArticleTest extends \TestCase
{
    /** @test */
    public function can_initialize_a_new_empty_post()
    {
        $article = new FinalArticle();

        $this->assertInstanceOf(Locale::class, $article->getLocale());
        $this->assertEquals('en', (string) $article->getLocale());

        $this->assertInstanceOf(UUID::class, $article->getIdentity());
        $this->assertRegexp('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', (string) $article->getIdentity());

        $this->assertInstanceOf(String::class, $article->getTitle());
        $this->assertEquals('', (string) $article->getTitle());

        $this->assertInstanceOf(Slug::class, $article->getSlug());
        $this->assertEquals('', (string) $article->getSlug());

        $this->assertInstanceOf(DateTime::class, $article->getPublishAt());
        $this->assertEquals($this->dateTimeNowIso(), (string) $article->getPublishAt());

        $this->assertInstanceOf(String::class, $article->getBody());
        $this->assertEquals('', (string) $article->getBody());
    }

    /** @test */
    public function can_initialize_a_draft()
    {
        $article = new DraftArticle();

        $this->assertInstanceOf(Locale::class, $article->getLocale());
        $this->assertEquals('en', (string) $article->getLocale());

        $this->assertInstanceOf(UUID::class, $article->getIdentity());
        $this->assertRegexp('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', (string) $article->getIdentity());

        $this->assertInstanceOf(String::class, $article->getTitle());
        $this->assertEquals('', (string) $article->getTitle());

        $this->assertInstanceOf(Slug::class, $article->getSlug());
        $this->assertEquals('', (string) $article->getSlug());

        $this->assertInstanceOf(DateTime::class, $article->getPublishAt());
        $this->assertEquals($this->dateTimeNowIso(), (string) $article->getPublishAt());

        $this->assertInstanceOf(String::class, $article->getBody());
        $this->assertEquals('', (string) $article->getBody());
    }

    /** @test */
    public function can_initialize_with_data()
    {
        $article = new FinalArticle();

        $uuid = new UUID();

        $article->setIdentity($uuid->toNative());
        $article->setLocale('en');
        $article->setTitle('Some Post');
        $article->setSlug('some-post');
        $article->setPublishAt('now');
        $article->setBody('Lorem ipsum');

        $this->assertEquals($uuid->toNative(),       (string) $article->getIdentity());
        $this->assertEquals('en',                    (string) $article->getLocale());
        $this->assertEquals('English',               (string) $article->getLocale()->getLanguageName());
        $this->assertEquals('Some Post',             (string) $article->getTitle());
        $this->assertEquals('some-post',             (string) $article->getSlug());
        $this->assertEquals($this->dateTimeNowIso(), (string) $article->getPublishAt());
        $this->assertEquals('Lorem ipsum',           (string) $article->getBody());
    }

    /** @test */
    public function can_see_if_article_is_public()
    {
        $articlePast = new FinalArticle();
        $articleFuture = new FinalArticle();
        $draftPast = new DraftArticle();
        $draftFuture = new DraftArticle();

        $articlePast->setPublishAt('-1 day');
        $articleFuture->setPublishAt('+1 day');
        $draftPast->setPublishAt('-1 day');
        $draftFuture->setPublishAt('+1 day');

        $this->assertTrue($articlePast->isPublic(), 'Article published in the past should be public!');
        $this->assertFalse($articleFuture->isPublic(), 'Article published in the future should not be public!');
        $this->assertFalse($draftPast->isPublic(), 'Draft published in the past should not be public!');
        $this->assertFalse($draftFuture->isPublic(), 'Draft published in the future should not be public!');
    }

    /** @test */
    public function can_make_final_from_draft()
    {
        $draft = new DraftArticle();

        $uuid = new UUID();

        $draft->setIdentity($uuid->toNative());
        $draft->setLocale('da');
        $draft->setTitle('Some Post');
        $draft->setSlug('some-post');
        $draft->setPublishAt('now');
        $draft->setBody('Lorem ipsum');
        
        $final = $draft->makeFinal();

        $this->assertTrue($draft->isDraft(), 'Draft article should be a draft!');
        $this->assertFalse($final->isDraft(), 'Final article should not be a draft!');
        $this->assertEquals($uuid->toNative(),       (string) $final->getIdentity());
        $this->assertEquals('da',                    (string) $final->getLocale());
        $this->assertEquals('Danish',                (string) $final->getLocale()->getLanguageName());
        $this->assertEquals('Some Post',             (string) $final->getTitle());
        $this->assertEquals('some-post',             (string) $final->getSlug());
        $this->assertEquals($this->dateTimeNowIso(), (string) $final->getPublishAt());
        $this->assertEquals('Lorem ipsum',           (string) $final->getBody());
    }

    /** @test */
    public function can_make_draft_from_final()
    {
        $final = new FinalArticle();

        $uuid = new UUID();

        $final->setIdentity($uuid->toNative());
        $final->setLocale('da');
        $final->setTitle('Some Post');
        $final->setSlug('some-post');
        $final->setPublishAt('now');
        $final->setBody('Lorem ipsum');

        $draft = $final->makeDraft();

        $this->assertFalse($final->isDraft(), 'Final article should not be a draft!');
        $this->assertTrue($draft->isDraft(), 'Draft article should be a draft!');
        $this->assertEquals($uuid->toNative(),       (string) $draft->getIdentity());
        $this->assertEquals('da',                    (string) $draft->getLocale());
        $this->assertEquals('Danish',                (string) $draft->getLocale()->getLanguageName());
        $this->assertEquals('Some Post',             (string) $draft->getTitle());
        $this->assertEquals('some-post',             (string) $draft->getSlug());
        $this->assertEquals($this->dateTimeNowIso(), (string) $draft->getPublishAt());
        $this->assertEquals('Lorem ipsum',           (string) $draft->getBody());
    }


    private function dateTimeNowIso()
    {
        $dateTime    = new \DateTime('now');
        return $dateTime->format(\DateTime::ISO8601);
    }
}
