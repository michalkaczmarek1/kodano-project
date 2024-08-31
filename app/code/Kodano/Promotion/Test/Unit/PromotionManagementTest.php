<?php

declare(strict_types=1);

namespace Kodano\Promotion\Test\Unit;

use Kodano\Promotion\Api\Data\PromotionGroupInterface;
use Kodano\Promotion\Api\Data\PromotionGroupSearchResultsInterface;
use Kodano\Promotion\Api\Data\PromotionInterface;
use Kodano\Promotion\Api\PromotionGroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPUnit\Framework\TestCase;
use Kodano\Promotion\Model\PromotionManagement;
use Kodano\Promotion\Api\PromotionRepositoryInterface;
use Magento\Framework\Api\SearchCriteria;
use Kodano\Promotion\Api\Data\PromotionSearchResultsInterface;

class PromotionManagementTest extends TestCase
{
    private $promotionRepositoryInterfaceMock;
    private $promotionGroupRepositoryInterfaceMock;
    private $promotionGroupSearchResultsInterfaceMock;
    private $promotionSearchResultsInterfaceMock;
    private $searchCriteriaBuilderMock;
    private $searchCriteria;
    private $promotionManagement;

    protected function setUp(): void
    {
        $this->promotionRepositoryInterfaceMock = $this->createMock(PromotionRepositoryInterface::class);
        $this->promotionGroupRepositoryInterfaceMock = $this->createMock(PromotionGroupRepositoryInterface::class);
        $this->promotionSearchResultsInterfaceMock = $this->createMock(PromotionSearchResultsInterface::class);
        $this->promotionGroupSearchResultsInterfaceMock = $this->createMock(PromotionGroupSearchResultsInterface::class);
        $this->searchCriteriaBuilderMock = $this->createMock(SearchCriteriaBuilder::class);
        $this->searchCriteria = new SearchCriteria();
        $this->searchCriteriaBuilderMock->method('create')->willReturn($this->searchCriteria);
        $this->promotionManagement = new PromotionManagement(
            $this->promotionRepositoryInterfaceMock,
            $this->promotionGroupRepositoryInterfaceMock,
            $this->searchCriteriaBuilderMock
        );
    }

    public function testGetPromotions(): void
    {
        $expectedPromotions = ['promotion1', 'promotion2'];
        $this->promotionSearchResultsInterfaceMock->method('getItems')
            ->willReturn($expectedPromotions);
        $this->promotionRepositoryInterfaceMock->method('getList')
            ->with($this->searchCriteria)
            ->willReturn($this->promotionSearchResultsInterfaceMock);

        $actualPromotions = $this->promotionManagement->getPromotions();

        $this->assertEquals($expectedPromotions, $actualPromotions);
    }

    public function testGetPromotionGroups(): void
    {
        $expectedPromotionGroups = ['promotionGroup1', 'promotionGroup2'];
        $this->promotionGroupSearchResultsInterfaceMock->expects($this->once())
            ->method('getItems')
            ->willReturn($expectedPromotionGroups);
        $this->promotionGroupRepositoryInterfaceMock->method('getList')
            ->with($this->searchCriteria)
            ->willReturn($this->promotionGroupSearchResultsInterfaceMock);

        $actualPromotionGroups = $this->promotionManagement->getPromotionGroups();

        $this->assertSame($expectedPromotionGroups, $actualPromotionGroups);
    }

    public function testDeletePromotionWithInvalidPromotionId(): void
    {
        $this->expectException(NoSuchEntityException::class);

        $this->promotionRepositoryInterfaceMock->method('deleteById')
            ->with('-1')
            ->willThrowException(new NoSuchEntityException());

        $this->promotionManagement->deletePromotion('-1');
    }

    public function testDeletePromotionWithValidPromotionId(): void
    {
        $this->promotionRepositoryInterfaceMock->method('deleteById')
            ->with('1')
            ->willReturn(true);

        $result = $this->promotionManagement->deletePromotion('1');

        $this->assertTrue($result);
    }

    public function testDeletePromotionGroupWithInvalidPromotionGroupId(): void
    {
        $this->expectException(NoSuchEntityException::class);

        $this->promotionGroupRepositoryInterfaceMock->method('deleteById')
            ->with('-1')
            ->willThrowException(new NoSuchEntityException());

        $this->promotionManagement->deletePromotionGroup('-1');
    }

    public function testDeletePromotionGroupWithValidPromotionGroupId(): void
    {
        $this->promotionGroupRepositoryInterfaceMock->method('deleteById')
            ->with('1')
            ->willReturn(true);

        $result = $this->promotionManagement->deletePromotionGroup('1');

        $this->assertTrue($result);
    }


    public function testSavePromotion(): void
    {
        $promotionMock = $this->createMock(PromotionInterface::class);
        $this->promotionRepositoryInterfaceMock->expects($this->once())
            ->method('save')
            ->with($promotionMock)
            ->willReturn($promotionMock);

        $actualResult = $this->promotionManagement->savePromotion($promotionMock);

        $this->assertSame($promotionMock, $actualResult);
    }

    public function testSavePromotionGroupWithValidPromotionGroupAndNullPromotionId(): void
    {
        $promotionGroupMock = $this->createMock(PromotionGroupInterface::class);
        $promotionGroupMock->method('setPromotionId')->with(null);
        $this->promotionGroupRepositoryInterfaceMock->expects($this->once())
            ->method('save')
            ->with($promotionGroupMock)
            ->willReturn($promotionGroupMock);

        $actualResult = $this->promotionManagement->savePromotionGroup($promotionGroupMock);

        $this->assertSame($promotionGroupMock, $actualResult);
    }

    public function testSavePromotionGroupWithValidPromotionGroupAndNonEmptyPromotionId(): void
    {
        $promotionGroupMock = $this->createMock(PromotionGroupInterface::class);
        $validPromotionId = '12345';
        $promotionGroupMock->method('setPromotionId')->with($validPromotionId);
        $this->promotionGroupRepositoryInterfaceMock->expects($this->once())
            ->method('save')
            ->with($promotionGroupMock)
            ->willReturn($promotionGroupMock);

        $actualResult = $this->promotionManagement->savePromotionGroup($promotionGroupMock, $validPromotionId);

        $this->assertSame($promotionGroupMock, $actualResult);
    }
}
