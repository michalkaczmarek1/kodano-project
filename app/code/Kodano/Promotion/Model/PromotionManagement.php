<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model;

use Kodano\Promotion\Api\Data\PromotionGroupInterface;
use Kodano\Promotion\Api\Data\PromotionInterface;
use Kodano\Promotion\Api\PromotionGroupRepositoryInterface;
use Kodano\Promotion\Api\PromotionManagementInterface;
use Kodano\Promotion\Api\PromotionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class PromotionManagement implements PromotionManagementInterface
{
    public function __construct(
        private readonly PromotionRepositoryInterface      $promotionRepositoryInterface,
        private readonly PromotionGroupRepositoryInterface $promotionGroupRepositoryInterface,
        private readonly SearchCriteriaBuilder             $searchCriteriaBuilder
    )
    {
    }

    public function getPromotions(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->promotionRepositoryInterface->getList($searchCriteria)->getItems();
    }

    public function getPromotionGroups(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->promotionGroupRepositoryInterface->getList($searchCriteria)->getItems();
    }

    public function savePromotion(PromotionInterface $promotion): PromotionInterface
    {
        $this->promotionRepositoryInterface->save($promotion);

        return $promotion;
    }

    public function savePromotionGroup(PromotionGroupInterface $promotionGroup, string $promotionId = null): PromotionGroupInterface
    {
        if (!empty($promotionId)) {
            $promotionGroup->setPromotionId($promotionId);
        }

        $this->promotionGroupRepositoryInterface->save($promotionGroup);

        return $promotionGroup;
    }

    public function deletePromotion(string $promotionId): bool
    {
        if (!empty($promotionId)) {
            $this->promotionRepositoryInterface->deleteById($promotionId);
        }

        return true;
    }

    public function deletePromotionGroup(string $promotionGroupId): bool
    {
        if (!empty($promotionGroupId)) {
            $this->promotionGroupRepositoryInterface->deleteById($promotionGroupId);
        }

        return true;
    }
}
