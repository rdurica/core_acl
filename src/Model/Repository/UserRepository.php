<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Repository;

use Nette\Database\Table\ActiveRow;
use Rdurica\Core\Model\Repository\Repository;

/**
 * UserRepository.
 *
 * @package   Rdurica\CoreAcl\Model\Repository
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final class UserRepository extends Repository
{
    /** @var string Column. */
    public const PRIMARY_KEY = 'id';

    /** @var string Column. */
    public const USERNAME = 'username';

    /** @var string Column. */
    public const FIRST_NAME = 'first_name';

    /** @var string Column. */
    public const LAST_NAME = 'last_name';

    /** @var string Column. */
    public const EMAIL = 'email';

    /** @var string Column. */
    public const PASSWORD = 'password';

    /** @var string Column. */
    public const REGISTERED = 'registered';

    /** @var string Column. */
    public const ENABLED = 'is_enabled';

    /**
     * Find user by username.
     *
     * @param string $username
     *
     * @return ActiveRow|null
     */
    public function findByUsername(string $username): ?ActiveRow
    {
        return $this->select()
            ->where(self::USERNAME, $username)
            ->fetch();
    }

    /**
     * Find user by email.
     *
     * @param string $email
     *
     * @return ActiveRow|null
     */
    public function findByEmail(string $email): ?ActiveRow
    {
        return $this->select()
            ->where(self::EMAIL, $email)
            ->fetch();
    }

    /** @inheritDoc */
    protected function getTable(): string
    {
        return 'core_acl_user';
    }
}
