<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Data;

use Nette\Security\IIdentity;

/**
 * Identity.
 *
 * @package   Rdurica\CoreAcl\Model\Data
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final readonly class Identity implements IIdentity
{
    /**
     * Constructor.
     *
     * @param int                   $id       User id.
     * @param string                $username Username.
     * @param string                $email    Email.
     * @param array<string, string> $roles    User roles.
     */
    public function __construct(private int $id, private string $username, private string $email, private array $roles)
    {
    }

    /** @inheritDoc */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get user roles.
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        return array_keys($this->roles);
    }
}
