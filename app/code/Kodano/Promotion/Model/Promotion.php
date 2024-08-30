<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model;

use Kodano\Promotion\Api\Data\PromotionInterface;
use Magento\Framework\Model\AbstractModel;

class Promotion extends AbstractModel implements PromotionInterface
{
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Promotion::class);
    }

    public function getEntityId(): ?string
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setName(string $name): PromotionInterface
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
