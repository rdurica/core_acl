<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Service;

use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Rdurica\CoreAcl\Exception\DisabledAccountException;
use Rdurica\CoreAcl\Exception\InvalidCredentialsException;
use Rdurica\CoreAcl\Model\Data\Identity;
use Rdurica\CoreAcl\Model\Repository\UserRepository;
use Rdurica\CoreAcl\Model\Repository\UserRoleRepository;

/**
 * AuthenticationService.
 *
 * @package   Rdurica\CoreAcl\Model\Service
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final readonly class AuthenticationService implements Authenticator
{
    /**
     * Constructor.
     *
     * @param UserRepository     $userRepository
     * @param UserRoleRepository $userRoleRepository
     * @param Passwords          $passwords
     */
    public function __construct(
        private UserRepository $userRepository,
        private UserRoleRepository $userRoleRepository,
        private Passwords $passwords,
    ) {
    }

    /**
     * Perform authentication.
     *
     * @param string $user
     * @param string $password
     *
     * @return Identity
     * @throws InvalidCredentialsException
     * @throws DisabledAccountException
     */
    public function authenticate(string $user, string $password): Identity
    {
        $userRow = $this->userRepository->findByUsername($user);
        if (!$userRow) {
            throw new InvalidCredentialsException();
        }

        if (!$this->passwords->verify($password, $userRow[UserRepository::PASSWORD])) {
            throw new InvalidCredentialsException();
        }

        if ($userRow[UserRepository::ENABLED] === 0) {
            throw new DisabledAccountException();
        }

        $roles = $this->userRoleRepository->findByUserId($userRow[UserRepository::PRIMARY_KEY]);

        return new Identity(
            $userRow[UserRepository::PRIMARY_KEY],
            $userRow[UserRepository::USERNAME],
            $userRow[UserRepository::EMAIL],
            $roles
        );
    }
}
