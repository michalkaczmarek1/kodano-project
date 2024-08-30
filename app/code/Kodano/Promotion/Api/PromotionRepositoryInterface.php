<?php

declare(strict_types=1);

namespace Kodano\Promotion\Api;

use Kodano\Promotion\Api\Data\PromotionInterface;
use Kodano\Promotion\Api\Data\PromotionSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface PromotionRepositoryInterface
{
    /**
     * @param PromotionInterface $promotion
     * @return PromotionInterface
     */
    public function save(PromotionInterface $promotion): PromotionInterface;

    /**
     * @param string $promotionId
     * @return PromotionInterface
     */
    public function getById(string $promotionId): PromotionInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PromotionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PromotionSearchResultsInterface;

    /**
     * @param PromotionInterface $promotion
     * @return bool
     */
    public function delete(PromotionInterface $promotion): bool;

    /**
     * @param string $promotionId
     * @return bool
     */
    public function deleteById(string $promotionId): bool;
}
