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

namespace MageINIC\Grid\Api;

use MageINIC\Grid\Api\Data;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface GridRepositoryInterface
 */
interface GridRepositoryInterface
{
    /**
     * Retrieve Grid By given id.
     *
     * @param int $Id
     * @return \MageINIC\Grid\Api\Data\GridInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $Id): Data\GridInterface;

    /**
     * Save Grid.
     *
     * @param \MageINIC\Grid\Api\Data\GridInterface $sizechart
     * @return \MageINIC\Grid\Api\Data\GridInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(Data\GridInterface $sizechart): Data\GridInterface;

    /**
     * Delete Grid.
     *
     * @param \MageINIC\Grid\Api\Data\GridInterface $sizechart
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException;
     */
    public function delete(Data\GridInterface $sizechart): bool;

    /**
     * Delete Grid by ID.
     *
     * @param int $Id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $Id): bool;

}
