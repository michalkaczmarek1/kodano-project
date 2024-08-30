<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model\ResourceModel\Promotion;

use Kodano\Promotion\Model\Promotion;
use Kodano\Promotion\Model\ResourceModel\Promotion as PromotionResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(Promotion::class, PromotionResourceModel::class);
    }
}
