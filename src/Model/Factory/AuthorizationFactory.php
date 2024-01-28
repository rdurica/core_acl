<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Factory;

use Nette\Caching\Cache;
use Nette\Caching\Storage;
use Nette\Security\Permission;
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
    private Cache $cache;

    /**
     * Constructor.
     *
     * @param AclRepository $aclRepository
     * @param Storage       $storage
     */
    public function __construct(private AclRepository $aclRepository, Storage $storage)
    {
        $this->cache = new Cache($storage, 'core_acl');
    }

    /**
     * @throws Throwable
     */
    public function create(): Permission
    {
        $aclData = $this->cache->load('acl_data');
        if ($aclData === null) {
            $aclData = $this->aclRepository->findAll();

            $this->cache->save('acl_data', $aclData, [
                $this->cache::Expire => '1 hour',
            ]);
        }

        $permission = new Permission();
        $permission->addRole('authenticated');

        foreach ($aclData as $row) {
            $permission->addRole($row->role);
            $permission->addResource($row->resource);
            $permission->allow($row->role, $row->resource, $row->privilege);
        }

        return $permission;
    }
}
