<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api\Data
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api\Data;

/**
 * Interface SliderInterface
 */
interface SliderInterface
{
    /** Slider ID */
    const SLIDER_ID = 'slider_id';

    /** Slide title */
    const TITLE = 'title';

    /** Is slide active */
    const IS_ACTIVE = 'is_active';

    /** Show menu flag */
    const SHOW_MENU = 'show_menu';

    /** Show navigation flag */
    const SHOW_NAVIGATION = 'show_navigation';

    /** Slide speed */
    const SLIDE_SPEED = 'slide_speed';

    /** Slider position */
    const POSITION = 'position';

    /** Animation speed */
    const ANIMATION_SPEED = 'animation_speed';

    /** Slides to display */
    const SLIDES_TO_DISPLAY = 'slides_to_display';

    /** Slides to scroll */
    const SLIDES_TO_SCROLL = 'slides_to_scroll';

    /** Lazy load flag */
    const LAZY_LOAD = 'lazy_load';

    /** Slides to display on tablet */
    const SLIDES_TO_DISPLAY_TABLET = 'slides_to_display_tablet';

    /** Slides to scroll on tablet */
    const SLIDES_TO_SCROLL_TABLET = 'slides_to_scroll_tablet';

    /** Slides to display on mobile */
    const SLIDES_TO_DISPLAY_MOBILE = 'slides_to_display_mobile';

    /** Slides to scroll on mobile */
    const SLIDES_TO_SCROLL_MOBILE = 'slides_to_scroll_mobile';

    /**
     * Get slider ID
     * @return int
     */
    public function getId();

    /**
     * Get slider title
     * @return string
     */
    public function getTitle();

    /**
     * Check if slider is active
     * @return bool
     */
    public function getIsActive();

    /**
     * Check if menu is shown
     * @return bool
     */
    public function getIsMenuShown();

    /**
     * Check if navigation is shown
     * @return bool
     */
    public function getIsNavigationShown();

    /**
     * Get slide speed
     * @return int
     */
    public function getSlideSpeed();

    /**
     * Get slider position
     * @return int
     */
    public function getPosition();

    /**
     * Get animation speed
     * @return int
     */
    public function getAnimationSpeed();

    /**
     * Get the number of slides to display
     * @return int
     */
    public function getDesktopSlidesNum();

    /**
     * Get the number of slides to scroll
     * @return int
     */
    public function getDesktopScrollSlidesNum();

    /**
     * Check if slider is lazy-loaded
     * @return bool
     */
    public function getIsLazyLoaded();

    /**
     * Get the number of slides to display on tablet
     * @return int
     */
    public function getTabletSlidesNum();

    /**
     * Get the number of slides to scroll on tablet
     * @return int
     */
    public function getTabletScrollSlidesNum();

    /**
     * Get the number of slides to display on mobile
     * @return int
     */
    public function getMobileSlidesNum();

    /**
     * Get the number of slides to scroll on mobile
     * @return int
     */
    public function getMobileScrollSlidesNum();

    /**
     * Gets all active slides of this slider
     * with store and date filters applied
     * @return \Scandiweb\Slider\Api\Data\SlideInterface[]
     */
    public function getSlides();

    /**
     * Set slider ID
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set slider title
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set slider is active flag
     * @param bool $isActive
     * @return bool
     */
    public function setIsActive($isActive);

    /**
     * Set show menu flag
     * @param bool $isMenuShown
     * @return $this
     */
    public function setIsMenuShown($isMenuShown);

    /**
     * Set show navigation flag
     * @param bool $isNavigationShown
     * @return $this
     */
    public function setIsNavigationShown($isNavigationShown);

    /**
     * Set slide speed
     * @param int $speed
     * @return $this
     */
    public function setSlideSpeed($speed);

    /**
     * Set slider position
     * @param int $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * Set animation speed
     * @param int $speed
     * @return $this
     */
    public function setAnimationSpeed($speed);

    /**
     * Set the number of displayed slides
     * @param int $slidesNum
     * @return $this
     */
    public function setDesktopSlidesNum($slidesNum);

    /**
     * Set the number of scrolled slides
     * @param int $slidesNum
     * @return $this
     */
    public function setDesktopScrollSlidesNum($slidesNum);

    /**
     * Set if slider should be lazy-loaded
     * @param bool $isLazyLoaded
     * @return bool
     */
    public function setIsLazyLoaded($isLazyLoaded);

    /**
     * Set the number of displayed slides on tablet
     * @param int $slidesNum
     * @return $this
     */
    public function setTabletSlidesNum($slidesNum);

    /**
     * Set the number of scrolled slides on tablet
     * @param int $slidesNum
     * @return $this
     */
    public function setTabletScrollSlidesNum($slidesNum);

    /**
     * Set the number of displayed slides on mobile
     * @param int $slidesNum
     * @return $this
     */
    public function setMobileSlidesNum($slidesNum);

    /**
     * Set the number of scrolled slides on mobile
     * @param int $slidesNum
     * @return $this
     */
    public function setMobileScrollSlidesNum($slidesNum);
}
