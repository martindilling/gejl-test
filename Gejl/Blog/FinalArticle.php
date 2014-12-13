<?php namespace Gejl\Blog;

class FinalArticle extends AbstractArticle
{
    /**
     * Is the article a draft.
     *
     * @return bool
     */
    public function isDraft()
    {
        return false;
    }
}
