<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Constant;

/**
 * Role.
 *
 * @package   Rdurica\CoreAcl\Constant
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
class Role
{
    /** Default role. */
    public const USER = 'user';

    /** Site admin. */
    public const  ADMIN = 'site_admin';

    /** Global admin (has all rights). */
    public const  GLOBAL_ADMIN = 'global_admin';
}
