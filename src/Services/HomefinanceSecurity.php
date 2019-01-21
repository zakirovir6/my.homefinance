<?php
declare(strict_types=1);

namespace App\Services;

use App\Entity\User;
use App\Exception\SecurityException;
use \Symfony\Component\Security\Core\Security as SymfonySecurity;

class HomefinanceSecurity
{
    /** @var SymfonySecurity */
    private $security;

    public function __construct(SymfonySecurity $security)
    {
        $this->security = $security;
    }

    /**
     * @return User
     * @throws SecurityException
     */
    public function getUser(): User
    {
        $user = $this->security->getUser();

        if (!$user instanceof User) {
            throw new SecurityException('User object not supported');
        }

        return $user;
    }
}
