<?php namespace Gejl\Blog;

class BlogTest extends \TestCase
{
    /** @test */
    public function it_can_have_zero_articles()
    {
        $blog = new Blog();

        $this->assertEquals([], $blog->getAllArticles());
    }

    /** @test */
    public function it_can_have_articles()
    {
        $blog = new Blog();

        $article1 = new FinalArticle();
        $article1->setTitle('Some Post 1');
        $article1->setSlug('some-post-1');
        $article1->setPublishAt('now');
        $article1->setBody('Lorem ipsum 1');

        $article2 = new FinalArticle();
        $article2->setTitle('Some Post 2');
        $article2->setSlug('some-post-2');
        $article2->setPublishAt('now');
        $article2->setBody('Lorem ipsum 2');

        $blog->add($article1);
        $blog->add($article2);

        $this->assertEquals([$article1, $article2], $blog->getAllArticles());
    }

    /** @test */
    public function it_can_get_public_articles()
    {
        $blog = new Blog();

        $article1 = new FinalArticle();
        $article1->setTitle('Some Article 1');
        $article1->setSlug('some-article-1');
        $article1->setPublishAt('now');
        $article1->setBody('Lorem ipsum 1');

        $article2 = new FinalArticle();
        $article2->setTitle('Some Article 2');
        $article2->setSlug('some-article-2');
        $article2->setPublishAt('now');
        $article2->setBody('Lorem ipsum 2');

        $draft1 = new DraftArticle();
        $draft1->setTitle('Some Draft 1');
        $draft1->setSlug('some-draft-1');
        $draft1->setPublishAt('now');
        $draft1->setBody('Lorem ipsum 1');

        $draft2 = new DraftArticle();
        $draft2->setTitle('Some Draft 2');
        $draft2->setSlug('some-draft-2');
        $draft2->setPublishAt('now');
        $draft2->setBody('Lorem ipsum 2');

        $blog->add($article1);
        $blog->add($draft1);
        $blog->add($article2);
        $blog->add($draft2);

        $publicArticles = $blog->getPublicArticles();

        $this->assertEquals($article1, $publicArticles[0]);
        $this->assertEquals($article2, $publicArticles[1]);
    }

    /** @test */
    public function it_can_get_not_public_articles()
    {
        $blog = new Blog();

        $article1 = new FinalArticle();
        $article1->setTitle('Some Article 1');
        $article1->setSlug('some-article-1');
        $article1->setPublishAt('now');
        $article1->setBody('Lorem ipsum 1');

        $article2 = new FinalArticle();
        $article2->setTitle('Some Article 2');
        $article2->setSlug('some-article-2');
        $article2->setPublishAt('now');
        $article2->setBody('Lorem ipsum 2');

        $draft1 = new DraftArticle();
        $draft1->setTitle('Some Draft 1');
        $draft1->setSlug('some-draft-1');
        $draft1->setPublishAt('now');
        $draft1->setBody('Lorem ipsum 1');

        $draft2 = new DraftArticle();
        $draft2->setTitle('Some Draft 2');
        $draft2->setSlug('some-draft-2');
        $draft2->setPublishAt('now');
        $draft2->setBody('Lorem ipsum 2');

        $blog->add($article1);
        $blog->add($draft1);
        $blog->add($article2);
        $blog->add($draft2);

        $privateArticles = $blog->getPrivateArticles();

        $this->assertEquals($draft1, $privateArticles[0]);
        $this->assertEquals($draft2, $privateArticles[1]);
    }
}
