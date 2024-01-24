<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Repository;

use Rdurica\Core\Model\Repository\Repository;

/**
 * UserRoleRepository.
 *
 * @package   Rdurica\CoreAcl\Model\Repository
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final class UserRoleRepository extends Repository
{
    /** @var string Column. */
    public const USER_ID = 'user_id';

    /** @var string Column. */
    public const ROLE_CODE = 'role_code';

    /**
     * Find all user roles by user id.
     *
     * @param int $userId
     *
     * @return array<string, string> All user roles [role_code => role_code]
     */
    public function findByUserId(int $userId): array
    {
        return $this->select()
            ->where(self::USER_ID, $userId)
            ->fetchPairs(self::ROLE_CODE, self::ROLE_CODE);
    }

    /** @inheritDoc */
    protected function getTable(): string
    {
        return 'core_acl_user_roles';
    }
}
