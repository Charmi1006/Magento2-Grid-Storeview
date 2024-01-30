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

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use MageINIC\Grid\Model\Grid;
use MageINIC\Grid\Model\GridRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use RuntimeException;

/**
 * Class SizeChart Save
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'MageINIC_Grid::save';

    /**
     * @var Grid
     */
    protected $sizeChartModel;

    /**
     * @var GridRepository
     */
    private GridRepository $sizeChartRepository;

    /**
     * @param Context $context
     * @param Grid $sizeChartModel
     * @param GridRepository $sizeChartRepository
     */
    public function __construct(
        Context             $context,
        Grid                $sizeChartModel,
        GridRepository $sizeChartRepository
    ) {
        $this->sizeChartModel = $sizeChartModel;
        parent::__construct($context);
        $this->sizeChartRepository = $sizeChartRepository;
    }

    /**
     * Save Sizechart
     *
     * @return Redirect
     * @throws NoSuchEntityException
     */
    public function execute(): Redirect
    {
        $data = $this->getRequest()->getPostValue();

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->sizeChartModel;
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $this->sizeChartRepository->getById($id);
            }
            $model->setData($data);
            $this->_eventManager->dispatch(
                'reporttoadmin_reasons_prepare_save',
                ['report' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->sizeChartRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Grid Successfully saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['id' => $model->getId(), '_current' => true]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException|RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the SizeChart'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }
}
