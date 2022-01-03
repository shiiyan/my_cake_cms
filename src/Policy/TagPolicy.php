<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Tag;
use Authorization\IdentityInterface;

/**
 * Tag policy
 */
class TagPolicy
{
    /**
     * Check if $identity can add Tag
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Tag $tag
     * @return bool
     */
    public function canView(IdentityInterface $identity, Tag $tag)
    {
        return true;
    }

    /**
     * Check if $identity can add Tag
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Tag $tag
     * @return bool
     */
    public function canAdd(IdentityInterface $identity, Tag $tag)
    {
        return true;
    }

    /**
     * Check if $identity can edit Tag
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Tag $tag
     * @return bool
     */
    public function canEdit(IdentityInterface $identity, Tag $tag)
    {
        return true;
    }

    /**
     * Check if $identity can delete Tag
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\Tag $tag
     * @return bool
     */
    public function canDelete(IdentityInterface $identity, Tag $tag)
    {
        return true;
    }
}
