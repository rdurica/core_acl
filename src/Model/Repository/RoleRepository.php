<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Repository;

use Rdurica\Core\Model\Repository\Repository;

/**
 * RoleRepository.
 *
 * @package   Rdurica\CoreAcl\Model\Repository
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final class RoleRepository extends Repository
{
    /** @var string Column. */
    public const PRIMARY_KEY = 'code';

    /** @inheritDoc */
    protected function getTable(): string
    {
        return 'core_acl_role';
    }
}
