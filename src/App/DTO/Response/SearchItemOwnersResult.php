<?php

/**
 * Description of SearchItemOwnersResult.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Eduard Danylov <eduard.danylov@dotsplatform.com>
 */

namespace Dotsplatform\SearchApiSdk\DTO\Response;

use Dots\Data\DTO;

class SearchItemOwnersResult extends DTO
{
    /** @var array<mixed> raw owner ids as returned by the service */
    protected array $ownerIds = [];

    /**
     * @return string[] company ids or shared Menu ids, ascending
     */
    public function getOwnerIds(): array
    {
        $ownerIds = [];
        foreach ($this->ownerIds as $ownerId) {
            if (! is_string($ownerId)) {
                continue;
            }

            $ownerIds[] = $ownerId;
        }

        return $ownerIds;
    }
}
