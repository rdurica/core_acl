<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Factory;

use Nette\InvalidStateException;
use Nette\Security\Permission;
use Rdurica\CoreAcl\Model\Data\AclData;
use Rdurica\CoreAcl\Model\Repository\AclRepository;
use Throwable;

/**
 * AuthorizationService.
 *
 * @package   Rdurica\CoreAcl\Model\Service
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final readonly class AuthorizationFactory
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
     * Create instance of {@see Permission}.
     *
     * @return Permission
     * @throws Throwable
     */
    public function create(): Permission
    {
        $aclData = $this->aclRepository->findAll();
        $permission = $this->initializePermission();

        foreach ($aclData as $row) {
            $this->addPermision($permission, $row);
        }

        return $permission;
    }

    /**
     * initialize permission object.
     *
     * @return Permission
     */
    private function initializePermission(): Permission
    {
        $permission = new Permission();
        $permission->addRole('authenticated');

        return $permission;
    }

    /**
     * Set one permision.
     *
     * @param Permission $permission
     * @param AclData    $aclData
     *
     * @return void
     */
    private function addPermision(Permission $permission, AclData $aclData): void
    {
        try {
            $permission->addRole($aclData->role);
            $permission->addResource($aclData->resource);
            $permission->allow($aclData->role, $aclData->resource, $aclData->privilege);
        } catch (InvalidStateException) {
            // Role already added. skipping
        }
    }
}
