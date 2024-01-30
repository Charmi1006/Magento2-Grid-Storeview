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

namespace MageINIC\Grid\Controller\Adminhtml\Grid;

use MageINIC\Grid\Api\GridRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use MageINIC\Grid\Controller\Adminhtml\Grid;
use MageINIC\Grid\Model\GridFactory;

/**
 * Class SizeChart Edit
 */
class Edit extends Grid implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'MageINIC_Grid::edit';

    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
     * @var GridFactory
     */
    private GridFactory $sizeChartFactory;

    /**
     * @var Registry
     */
    protected Registry $coreRegistry;

    /**
     * @var GridRepositoryInterface
     */
    private GridRepositoryInterface $sizeChartRepository;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param GridFactory $sizeChartFactory
     * @param GridRepositoryInterface $sizeChartRepository
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        GridFactory $sizeChartFactory,
        GridRepositoryInterface $sizeChartRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->sizeChartFactory = $sizeChartFactory;
        $this->coreRegistry = $coreRegistry;
        $this->sizeChartRepository = $sizeChartRepository;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return Page|Redirect
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->sizeChartFactory->create();
        if ($id) {
            $model = $this->sizeChartRepository->getById($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Grid no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->coreRegistry->register('grid', $model);
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Grid') : __('New Grid'),
            $id ? __('Edit Grid') : __('New Grid')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Grid'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Grid'));
        return $resultPage;
    }
}
