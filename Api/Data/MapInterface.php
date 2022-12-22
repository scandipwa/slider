<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api\Data
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api\Data;

/**
 * Interface MapInterface
 */
interface MapInterface
{
    /** Slide ID */
    const SLIDE_ID = 'slide_id';

    /** Title */
    const TITLE = 'title';

    /** Coordinates */
    const COORDINATES = 'coordinates';

    /** Is active flag */
    const IS_ACTIVE = 'is_active';

    /** Product ID */
    const PRODUCT_ID = 'product_id';

    /**
     * Get map ID
     * @return int
     */
    public function getId();

    /**
     * Get slide ID
     * @return int
     */
    public function getSlideId();

    /**
     * Get title
     * @return string
     */
    public function getTitle();

    /**
     * Get coordinates
     * @return string
     */
    public function getCoordinates();

    /**
     * Get is active flag
     * @return bool
     */
    public function getIsActive();

    /**
     * Get product ID
     * @return int
     */
    public function getProductId();

    /**
     * Set map ID
     * @param int $id
     * @return this
     */
    public function setId($id);

    /**
     * Set slide ID
     * @param int $id
     * @return this
     */
    public function setSlideId($id);

    /**
     * Set title
     * @param string $title
     * @return this
     */
    public function setTitle($title);

    /**
     * Set coordinates
     * @param string $coordinates
     * @return this
     */
    public function setCoordinates($coordinates);

    /**
     * Set is active flag
     * @param bool $isActive
     * @return this
     */
    public function setIsActive($isActive);

    /**
     * Set product ID
     * @param int $id
     * @return this
     */
    public function setProductId($id);
}
