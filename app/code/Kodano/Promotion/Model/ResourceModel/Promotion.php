<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Promotion extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('promotion_entity', 'entity_id');
    }
}
