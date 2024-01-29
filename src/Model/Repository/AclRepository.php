<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Repository;

use Nette\Caching\Storage;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Rdurica\Core\Model\Builder\CacheBuilder;
use Rdurica\Core\Model\Repository\Repository;
use Rdurica\Core\Model\Repository\Transaction;
use Rdurica\CoreAcl\Model\Data\AclData;
use Throwable;

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

    private CacheBuilder $cache;

    public function __construct(Explorer $explorer, Transaction $transaction, Storage $storage)
    {
        parent::__construct($explorer, $transaction);

        $this->cache = CacheBuilder::create($storage, __CLASS__);
    }

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
     * Find all
     *
     * @param bool $useCache
     *
     * @return AclData[]
     * @throws Throwable
     */
    public function findAll(bool $useCache = true): array
    {
        $aclData = $this->cache->load();
        if ($aclData && $useCache === true) {
            return $aclData;
        }

        $dataFromDatabase = $this->select();
        $aclData = AclData::createArray($dataFromDatabase);
        $this->cache->save($aclData);

        return $aclData;
    }

    /** @inheritDoc */
    protected function getTable(): string
    {
        return 'core_acl';
    }
}
