<?php namespace Gejl\Blog;

class Blog
{
    protected $articles = [];

    public function add(AbstractArticle $article)
    {
        $this->articles[] = $article;
    }

    public function getAllArticles()
    {
        return $this->articles;
    }

    public function getPublicArticles()
    {
        $publicArticles = array_filter($this->articles, function($article) {
            return $article->isPublic();
        });

        return array_values($publicArticles);
    }

    public function getPrivateArticles()
    {
        $privateArticles = array_filter($this->articles, function($article) {
            return !$article->isPublic();
        });

        return array_values($privateArticles);
    }
}
