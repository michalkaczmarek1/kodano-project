<?php

declare(strict_types=1);

namespace Kodano\Promotion\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PromotionGroupSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
