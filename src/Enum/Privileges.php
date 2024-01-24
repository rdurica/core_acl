<?php declare(strict_types=1);

namespace Rdurica\CoreAcl\Enum;

/**
 * Privileges.
 *
 * @package   Rdurica\CoreAcl\Enum
 * @copyright Copyright (c) 2024, Robert Durica
 * @since     2024-01-24
 */
enum Privileges: string
{
    /** Allow to view. */
    case VIEW = 'view';

    /** Allow to create. */
    case CREATE = 'create';

    /** Allow to edit. */
    case EDIT = 'edit';

    /** Allow to delete. */
    case DELETE = 'delete';

    /** Allow all operations. */
    case ALL = 'all';
}
