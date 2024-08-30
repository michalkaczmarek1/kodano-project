<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PromotionGroup extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('promotion_group_entity', 'entity_id');
    }
}
