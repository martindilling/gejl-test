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

    /**
     * Make draft to final article
     *
     * @return DraftArticle
     */
    public function makeDraft()
    {
        return new DraftArticle(
            (string) $this->getTitle(),
            (string) $this->getSlug(),
            (string) $this->getPublishAt(),
            (string) $this->getBody()
        );
    }
}
