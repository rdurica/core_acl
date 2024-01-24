<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Service;

use Nette\Security\Authorizator;
use Rdurica\CoreAcl\Constant\Role;
use Rdurica\CoreAcl\Enum\Privileges;

use function array_key_exists;
use function is_string;

/**
 * AuthorizationService.
 *
 * @package   Rdurica\CoreAcl\Model\Service
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final readonly class AuthorizationService implements Authorizator
{
    /**
     * Constructor.
     *
     * @param SessionService $sessionService
     */
    public function __construct(private SessionService $sessionService)
    {
    }

    /** @inheritDoc */
    public function isAllowed(?string $role, ?string $resource, mixed $privilege): bool
    {
        if ($role === Role::GLOBAL_ADMIN) {
            return true;
        }

        $resources = $this->sessionService->getUserResourcesAndPrivileges();

        // User does not have resource
        if (empty($resources[$resource])) {
            return false;
        }

        $privilege = is_string($privilege) ? $privilege : $privilege->value;

        // User have exact privilege or can do all
        $hasPrivilege = array_key_exists($privilege, $resources[$resource]);
        $hasAllPrivileges = array_key_exists(Privileges::ALL->value, $resources[$resource]);

        return ($hasPrivilege || $hasAllPrivileges);
    }
}
