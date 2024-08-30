<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model;

use Kodano\Promotion\Api\Data\PromotionGroupInterface;
use Magento\Framework\Model\AbstractModel;

class PromotionGroup extends AbstractModel implements PromotionGroupInterface
{
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Promotion::class);
    }

    public function getEntityId(): ?string
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function getPromotionId(): ?string
    {
        return $this->getData(self::PROMOTION_ID);
    }

    public function setPromotionId(string $promotionId): PromotionGroupInterface
    {
        $this->setData(self::PROMOTION_ID, $promotionId);

        return $this;
    }

    public function setName(string $name): PromotionGroupInterface
    {
        $this->setData(self::NAME, $name);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }
}
