<?php
/**
 * MageINIC
 * Copyright (C) 2023 MageINIC <support@mageinic.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see https://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category MageINIC
 * @package MageINIC_Grid
 * @copyright Copyright (c) 2023 MageINIC (https://www.mageinic.com/)
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MageINIC <support@mageinic.com>
 */

namespace MageINIC\Grid\Model;

use Exception;
use MageINIC\Grid\Api\Data\GridSearchResultsInterfaceFactory as SearchResultsFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\Search\SearchResultFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use MageINIC\Grid\Api\Data\GridInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use MageINIC\Grid\Api\GridRepositoryInterface;
use MageINIC\Grid\Model\ResourceModel\Grid as ResourceSizeChart;
use MageINIC\Grid\Model\ResourceModel\Grid\CollectionFactory as SizeChartCollectionFactory;

/**
 * Class SizeChart SizeChartRepository
 */
class GridRepository implements GridRepositoryInterface
{
    /**
     * @var SizeChartCollectionFactory
     */
    public SizeChartCollectionFactory $GridFactory;
    /**
     * @var ResourceSizeChart
     */
    protected ResourceSizeChart $resource;

    /**
     * @var DataObjectHelper
     */
    protected DataObjectHelper $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected DataObjectProcessor $dataObjectProcessor;

    /**
     * @var SearchResultFactory
     */
    public SearchResultFactory $sizeSearchResult;

    /**
     * @var CollectionProcessor
     */
    public CollectionProcessor $collectionProcessor;

    /**
     * @var GridCollectionFactory
     */
    private GridCollectionFactory $GridCollectionFactory;

    /**
     * @var SearchResultsFactory
     */
    private SearchResultsFactory $SearchResultsFactory;
    private GridFactory $gridFactory;

    /**
     * @param ResourceSizeChart $resource
     * @param GridFactory $GridFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessor $collectionProcessor
     * @param SearchResultFactory $sizeSearchResult
     * @param SearchResultsFactory $SearchResultsFactory
     */
    public function __construct(
        ResourceSizeChart          $resource,
        GridFactory                 $GridFactory,
        DataObjectHelper           $dataObjectHelper,
        DataObjectProcessor        $dataObjectProcessor,
        CollectionProcessor        $collectionProcessor,
        SearchResultFactory        $sizeSearchResult,
        SearchResultsFactory       $SearchResultsFactory
    ) {
        $this->resource = $resource;
        $this->gridFactory = $GridFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->sizeSearchResult = $sizeSearchResult;
        $this->SearchResultsFactory = $SearchResultsFactory;
    }

    /**
     * @inheritdoc
     */
    public function save(GridInterface $sizechart): GridInterface
    {
        try {
            $this->resource->save($sizechart);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $sizechart;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $Id): bool
    {
        return $this->delete($this->getById($Id));
    }

    /**
     * @inheritdoc
     */
    public function delete(GridInterface $sizechart): bool
    {
        try {
            $this->resource->delete($sizechart);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getById(int $Id): GridInterface
    {
        $sizeChart = $this->gridFactory->create();
        $this->resource->load($sizeChart, $Id);
        if (!$sizeChart->getId()) {
            throw new NoSuchEntityException(__('The SizeChart with the "%1" ID does\'t exist.', $Id));
        }
        return $sizeChart;
    }
}
