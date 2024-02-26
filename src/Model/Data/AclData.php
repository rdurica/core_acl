<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Data;

use Nette\Database\Table\Selection;

/**
 * AclData.
 *
 * @package   Rdurica\CoreAcl\Model\Data
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-28
 */
final class AclData
{
    public function __construct(public int $id, public string $role, public string $resource, public string $privilege)
    {
    }

    /**
     * @return AclData[]
     */
    public static function createArray(Selection $data): array
    {
        $result = [];
        foreach ($data as $item) {
            $result[] = new AclData($item->id, $item->role_code, $item->resource_code, $item->privilege_code);
        }

        return $result;
    }
}
