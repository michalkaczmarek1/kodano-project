<?php

declare(strict_types=1);

namespace Kodano\Promotion\Api\Data;

interface PromotionInterface
{
    public const string ENTITY_ID = 'entity_id';
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
     * @return PromotionInterface
     */
    public function setName(string $name): PromotionInterface;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;
}
