<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model\ResourceModel\PromotionGroup;

use Kodano\Promotion\Model\PromotionGroup;
use Kodano\Promotion\Model\ResourceModel\PromotionGroup as PromotionGroupResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(PromotionGroup::class, PromotionGroupResourceModel::class);
    }
}
