<?php

declare(strict_types=1);

namespace Kodano\Promotion\Api;

use Kodano\Promotion\Api\Data\PromotionGroupInterface;
use Kodano\Promotion\Api\Data\PromotionGroupSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface PromotionGroupRepositoryInterface
{
    /**
     * @param PromotionGroupInterface $promotionGroup
     * @return PromotionGroupInterface
     */
    public function save(PromotionGroupInterface $promotionGroup): PromotionGroupInterface;

    /**
     * @param string $promotionGroupId
     * @return PromotionGroupInterface
     */
    public function getById(string $promotionGroupId): PromotionGroupInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PromotionGroupSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PromotionGroupSearchResultsInterface;

    /**
     * @param PromotionGroupInterface $promotionGroup
     * @return bool
     */
    public function delete(PromotionGroupInterface $promotionGroup): bool;

    /**
     * @param string $promotionGroupId
     * @return bool
     */
    public function deleteById(string $promotionGroupId): bool;
}
