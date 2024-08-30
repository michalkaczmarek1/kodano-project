<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model;

use Exception;
use Kodano\Promotion\Api\Data\PromotionGroupInterface;
use Kodano\Promotion\Api\Data\PromotionGroupSearchResultsInterface;
use Kodano\Promotion\Api\Data\PromotionGroupSearchResultsInterfaceFactory;
use Kodano\Promotion\Api\PromotionGroupRepositoryInterface;
use Kodano\Promotion\Model\ResourceModel\PromotionGroup;
use Kodano\Promotion\Model\ResourceModel\PromotionGroup\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PromotionGroupRepository implements PromotionGroupRepositoryInterface
{
    public function __construct(
        private readonly PromotionGroup                              $resourcePromotionGroup,
        private readonly PromotionGroupFactory                       $promotionGroupFactory,
        private readonly CollectionFactory                           $promotionGroupCollectionFactory,
        private readonly PromotionGroupSearchResultsInterfaceFactory $promotionGroupSearchResults,
        private readonly CollectionProcessorInterface                $collectionProcessor
    )
    {
    }

    public function save(PromotionGroupInterface $promotionGroup): PromotionGroupInterface
    {
        try {
            $this->resourcePromotionGroup->save($promotionGroup);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $promotionGroup;
    }

    public function getById(string $promotionGroupId): PromotionGroupInterface
    {
        $promotionGroup = $this->promotionGroupFactory->create();
        $this->resourcePromotionGroup->load($promotionGroup, $promotionGroupId);
        if (!$promotionGroup->getId()) {
            throw new NoSuchEntityException(__('The Promotion Group with the "%1" ID doesn\'t exist.', $promotionGroupId));
        }

        return $promotionGroup;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): PromotionGroupSearchResultsInterface
    {
        $collection = $this->promotionGroupCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->promotionGroupSearchResults->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(PromotionGroupInterface $promotionGroup): bool
    {
        try {
            $this->resourcePromotionGroup->delete($promotionGroup);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    public function deleteById(string $promotionGroupId): bool
    {
        try {
            return $this->delete($this->getById($promotionGroupId));
        } catch (CouldNotDeleteException|NoSuchEntityException $e) {

        }

        return false;
    }
}
