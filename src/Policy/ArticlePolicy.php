<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Article;
use Authorization\IdentityInterface;

/**
 * Article policy
 */
class ArticlePolicy
{
    /**
     * Check if $identity can add Article
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canView(IdentityInterface $identity, Article $article)
    {
        return true;
    }

    /**
     * Check if $identity can add Article
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canAdd(IdentityInterface $identity, Article $article)
    {
        return true;
    }

    /**
     * Check if $identity can edit Article
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canEdit(IdentityInterface $identity, Article $article)
    {
        return $identity->getOriginalData()->isAdmin || $this->isAuthor($identity, $article);
    }

    /**
     * Check if $identity can delete Article
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canDelete(IdentityInterface $identity, Article $article)
    {
        return $identity->getOriginalData()->isAdmin || $this->isAuthor($identity, $article);
    }

    /**
     * Check if $identity can search Article
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canSearch(IdentityInterface $identity)
    {
        return true;
    }

    protected function isAuthor(IdentityInterface $identity, Article $article): bool
    {
        return $article->user_id === $identity->getIdentifier();
    }
}
