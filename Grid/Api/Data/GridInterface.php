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

namespace MageINIC\Grid\Api\Data;

use Magento\Framework\Exception\LocalizedException;

/**
 * Interface GridInterface
 */
interface GridInterface
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const NAME = 'name';

    /**
     * Get ID
     *
     * @return int
     */
    public function getGridId(): int;

    /**
     * Set ID
     *
     * @param int $sizeChartId
     * @return $this
     */
    public function setGridId(int $gridId): GridInterface;

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): GridInterface;

    /**
     * Set Name
     *
     * @param string $name
     * @return $this
     */
    public function setSName(string $name): GridInterface;

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string;

}
