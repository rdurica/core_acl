<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Model\Service;

use Nette\Http\Session;
use Nette\Http\SessionSection;

/**
 * SessionService.
 *
 * @package   Rdurica\CoreAcl\Model\Service
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
final readonly class SessionService
{
    /** @var string Session section. */
    private const SESSION_SECTION_ACL = 'core_acl';

    /** @var string Session subsection. */
    private const SECTION_RESOURCES = 'resources';

    /**
     * Constructor.
     *
     * @param Session $session
     */
    public function __construct(private Session $session)
    {
    }

    /**
     * Get resources & privileges from cache.
     *
     * @codeCoverageIgnore
     * @return array<int|string, array<int|string, mixed>>|null
     */
    public function getUserResourcesAndPrivileges(): ?array
    {
        return $this->getSection()[self::SECTION_RESOURCES];
    }

    /**
     * Save resources & privileges to cache.
     *
     * @param array<int|string, array<int|string, mixed>> $resources
     *
     * @return void
     */
    public function saveUserResourcesAndPrivileges(array $resources): void
    {
        $this->getSection()[self::SECTION_RESOURCES] = $resources;
    }

    /**
     * Get session section for acl.
     *
     * @return SessionSection
     */
    private function getSection(): SessionSection
    {
        return $this->session->getSection(self::SESSION_SECTION_ACL);
    }
}
