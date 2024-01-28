<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Data;

/**
 * AclData.
 *
 * @package   Rdurica\CoreAcl\Model\Data
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-28
 */
final class AclData
{
    public string $role;

    public string $resource;

    public string $privilege;
}
