<?php namespace Gejl\Blog;

class DraftArticle extends AbstractArticle
{
    /**
     * Is the article a draft.
     *
     * @return bool
     */
    public function isDraft()
    {
        return true;
    }

    /**
     * Make draft to final article
     * 
     * @return FinalArticle
     */
    public function makeFinal()
    {
        return FinalArticle::createFromArticle($this);
    }
}
