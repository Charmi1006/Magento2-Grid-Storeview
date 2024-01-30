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

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use MageINIC\Grid\Api\Data\GridInterface;
use MageINIC\Grid\Model\ResourceModel\Grid as ResourceModel;

/**
 * Class SizeChart SizeChart
 */
class Grid extends AbstractModel implements GridInterface
{
    /**
     * Config path
     */
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    /**+
     * @var string
     */
    protected $_eventPrefix = 'mageinic';

    /**
     * @var string
     */
    protected $_eventObject = 'sizechart';

    /**
     * @var string
     */
    protected $_idFieldName = self::ID;

    /**
     * @inheritdoc
     */
    public function getGridId(): int
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function setGridId($gridId): GridInterface
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritdoc
     */
    public function setTitle(string $title): GridInterface
    {
        return $this->getData(self::TITLE);
    }



    /**
     * SizeChart ResourceModel
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(ResourceModel ::class);
    }

    /**
     * Prepare SizeChart's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses(): array
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }

    public function setSName(string $name): GridInterface
    {
        return $this->getData(self::NAME);
    }

    public function getName(): string
    {
        return $this->getData(self::NAME);
    }
}
