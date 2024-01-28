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
readonly class SessionService
{
    /** @var string Session section. */
    private const SESSION_SECTION_ACL = 'core_acl';

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
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->getSection()[$key];
    }

    /**
     * Save resources & privileges to cache.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function save(string $key, mixed $value, int $expiration = 5): void
    {
        $expirationString = sprintf('%s minutes', $expiration);
        $this->getSection()->setExpiration($expirationString);
        $this->getSection()[$key] = $value;
    }

    /**
     * Get session section for acl.
     *
     * @return SessionSection
     */
    private function getSection(): SessionSection
    {
        return $this->session->getSection($this->getSectionKey());
    }

    /**
     * @return string
     */
    protected function getSectionKey(): string
    {
        return self::SESSION_SECTION_ACL;
    }
}
