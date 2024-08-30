<?php

declare(strict_types=1);

namespace Kodano\Promotion\Api\Data;

interface PromotionGroupInterface
{
    public const string ENTITY_ID = 'entity_id';
    public const string PROMOTION_ID = 'promotion_id';
    public const string NAME = 'name';
    public const string CREATED_AT = 'created_at';
    public const string UPDATED_AT = 'updated_at';

    /**
     * @return string|null
     */
    public function getEntityId(): ?string;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $name
     * @return PromotionGroupInterface
     */
    public function setName(string $name): PromotionGroupInterface;

    /**
     * @return string|null
     */
    public function getPromotionId(): ?string;

    /**
     * @param string $promotionId
     * @return PromotionGroupInterface
     */
    public function setPromotionId(string $promotionId): PromotionGroupInterface;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;
}
