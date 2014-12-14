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

    public function makeFinal()
    {
        return new FinalArticle(
            (string) $this->getTitle(),
            (string) $this->getSlug(),
            (string) $this->getPublishAt(),
            (string) $this->getBody()
        );
    }
}
