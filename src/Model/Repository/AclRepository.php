<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Repository;

use Nette\Database\Table\ActiveRow;
use Rdurica\Core\Model\Repository\Repository;
use Rdurica\CoreAcl\Model\Data\AclData;

/**
 * AclRepository.
 *
 * @package   Rdurica\CoreAcl\Model\Repository
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final class AclRepository extends Repository
{
    /** @var string Column. */
    public const PRIMARY_KEY = 'id';

    /** @var string Column. */
    public const RESOURCE_CODE = 'resource_code';

    /** @var string Column. */
    public const PRIVILEGE_CODE = 'privilege_code';

    /** @var string Column. */
    public const ROLE_CODE = 'role_code';

    /**
     * Find Resources & privileges for role
     *
     * @param array<int, string> $roles
     *
     * @return ActiveRow[]
     */
    public function findByRoles(array $roles): array
    {
        return $this->select(self::RESOURCE_CODE, self::PRIVILEGE_CODE)
            ->where(self::ROLE_CODE, array_values($roles))
            ->fetchAll();
    }

    /**
     * @return AclData[]
     */
    public function findAll(): array
    {
        $result = [];
        foreach ($this->select() as $item) {
            $aclData = new AclData();
            $aclData->role = $item->role_code;
            $aclData->resource = $item->resource_code;
            $aclData->privilege = $item->privilege_code;

            $result[] = $aclData;
        }

        return $result;
    }

    /** @inheritDoc */
    protected function getTable(): string
    {
        return 'core_acl';
    }
}
