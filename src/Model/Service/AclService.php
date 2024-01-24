<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Service;

use Rdurica\CoreAcl\Model\Repository\AclRepository;

use function array_key_exists;
use function count;

/**
 * AclService.
 *
 * @package   Rdurica\CoreAcl\Model\Service
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final readonly class AclService
{
    /**
     * Constructor.
     *
     * @param AclRepository $aclRepository
     */
    public function __construct(private AclRepository $aclRepository)
    {
    }

    /**
     * Finds Resources & Privileges for roles.
     *
     * @param string[] $roles
     *
     * @return array<int|string, array<int|string, mixed>>
     */
    public function findResourcesAndPrivilegesByRoles(array $roles): array
    {
        $result = [];
        if (count($roles) === 0) {
            return $result;
        }

        $aclData = $this->aclRepository->findByRoles($roles);
        foreach ($aclData as $row) {
            if (!array_key_exists($row[AclRepository::RESOURCE_CODE], $result)) {
                $result[$row[AclRepository::RESOURCE_CODE]] = [];
            }

            $entry = [$row[AclRepository::PRIVILEGE_CODE] => $row[AclRepository::PRIVILEGE_CODE]];
            $result[$row[AclRepository::RESOURCE_CODE]] += $entry;
        }

        return $result;
    }
}
