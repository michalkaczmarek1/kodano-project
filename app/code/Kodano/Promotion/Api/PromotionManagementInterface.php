<?php

declare(strict_types=1);

namespace Kodano\Promotion\Api;

interface PromotionManagementInterface
{
    /**
     * @return \Kodano\Promotion\Api\Data\PromotionInterface[]
     */
    public function getPromotions(): array;

    /**
     * @return \Kodano\Promotion\Api\Data\PromotionGroupInterface[]
     */
    public function getPromotionGroups(): array;

    /**
     * @param \Kodano\Promotion\Api\Data\PromotionInterface $promotion
     * @return \Kodano\Promotion\Api\Data\PromotionInterface
     */
    public function savePromotion(\Kodano\Promotion\Api\Data\PromotionInterface $promotion): \Kodano\Promotion\Api\Data\PromotionInterface;

    /**
     * @param \Kodano\Promotion\Api\Data\PromotionGroupInterface $promotionGroup
     * @param string|null $promotionId
     * @return \Kodano\Promotion\Api\Data\PromotionGroupInterface
     */
    public function savePromotionGroup(\Kodano\Promotion\Api\Data\PromotionGroupInterface $promotionGroup, string $promotionId = null): \Kodano\Promotion\Api\Data\PromotionGroupInterface;

    /**
     * @param string $promotionId
     * @return bool
     */
    public function deletePromotion(string $promotionId): bool;

    /**
     * @param string $promotionGroupId
     * @return bool
     */
    public function deletePromotionGroup(string $promotionGroupId): bool;
}

