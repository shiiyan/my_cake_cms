<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $identity can add User
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\User $user
     * @return bool
     */
    public function canView(IdentityInterface $identity, User $user)
    {
        return $identity->getOriginalData()->isAdmin || $this->isSameIdentity($identity, $user);
    }

    /**
     * Check if $identity can add User
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\User $user
     * @return bool
     */
    public function canAdd(?IdentityInterface $identity, User $user)
    {
        return $this->isAnonymousUser($identity) || $identity->getOriginalData()->isAdmin;
    }

    /**
     * Check if $identity can edit User
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\User $user
     * @return bool
     */
    public function canEdit(IdentityInterface $identity, User $user)
    {
        return $identity->getOriginalData()->isAdmin || $this->isSameIdentity($identity, $user);
    }

    /**
     * Check if $identity can delete User
     *
     * @param \Authorization\IdentityInterface $identity The user.
     * @param \App\Model\Entity\User $user
     * @return bool
     */
    public function canDelete(IdentityInterface $identity, User $user)
    {
        return $identity->getOriginalData()->isAdmin || $this->isSameIdentity($identity, $user);
    }

    protected function isSameIdentity(IdentityInterface $identity, User $user): bool
    {
        return $user->id === $identity->getIdentifier();
    }

    protected function isAnonymousUser(?IdentityInterface $identity): bool {
        return $identity == null;
    }
}
