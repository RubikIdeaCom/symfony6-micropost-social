<?php
namespace App\Security;

use DateTime;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UserChecker implements UserCheckerInterface {
    /**
     * Checks the user account before authentication.
     * @param User $user
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user) 
    {
        if($user->getBannedUntil() === null) {
            return;
        }

        $now = new DateTime();
        if($now < $user->getBannedUntil()) {
            throw new AccessDeniedException('The user is banned!');
        }
    }

    /**
     * Checks the user account after authentication.
     * @param User $user
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user)
    {

    }
}