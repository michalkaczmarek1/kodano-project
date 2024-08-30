<?php

declare(strict_types=1);

namespace Kodano\Promotion\Model;

use Exception;
use Kodano\Promotion\Api\Data\PromotionInterface;
use Kodano\Promotion\Api\Data\PromotionSearchResultsInterface;
use Kodano\Promotion\Api\Data\PromotionSearchResultsInterfaceFactory;
use Kodano\Promotion\Api\PromotionRepositoryInterface;
use Kodano\Promotion\Model\ResourceModel\Promotion;
use Kodano\Promotion\Model\ResourceModel\Promotion\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function __construct(
        private readonly Promotion                              $resourcePromotion,
        private readonly PromotionFactory                       $promotionFactory,
        private readonly CollectionFactory                      $promotionCollectionFactory,
        private readonly PromotionSearchResultsInterfaceFactory $promotionSearchResultsFactory,
        private readonly CollectionProcessorInterface           $collectionProcessor,
    )
    {
    }

    public function save(PromotionInterface $promotion): PromotionInterface
    {
        try {
            $this->resourcePromotion->save($promotion);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $promotion;
    }

    public function getById(string $promotionId): PromotionInterface
    {
        $promotion = $this->promotionFactory->create();
        if (!empty($promotionId)) {
            $this->resourcePromotion->load($promotion, $promotionId);
            if (!$promotion->getId()) {
                throw new NoSuchEntityException(__('The Promotion with the "%1" ID doesn\'t exist.', $promotionId));
            }
        }

        return $promotion;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): PromotionSearchResultsInterface
    {
        $collection = $this->promotionCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->promotionSearchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(PromotionInterface $promotion): bool
    {
        try {
            $this->resourcePromotion->delete($promotion);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    public function deleteById(string $promotionId): bool
    {
        try {
            return $this->delete($this->getById($promotionId));
        } catch (CouldNotDeleteException|NoSuchEntityException $e) {

        }

        return false;
    }
}
