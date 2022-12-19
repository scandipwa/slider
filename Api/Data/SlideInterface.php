<?php
/**
 * @category Scandiweb
 * @package Scandiweb\Slider\Api\Data
 * @author Denis Protassoff <info@scandiweb.com>
 * @copyright Copyright (c) 2022 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Api\Data;

/**
 * Interface SlideInterface
 */
interface SlideInterface
{
    /** Slide ID */
    const SLIDE_ID = 'slide_id';

    /** Parent slider ID */
    const SLIDER_ID = 'slider_id';

    /** Slide title */
    const TITLE = 'title';

    /** First block desktop image location */
    const FIRST_DESKTOP_IMAGE = 'desktop_image';

    /** First block mobile image location */
    const FIRST_MOBILE_IMAGE = 'mobile_image';

    /** Is slide active */
    const IS_ACTIVE = 'is_active';

    /** Slide position */
    const POSITION = 'position';

    /** Slide start time */
    const START_TIME = 'start_time';

    /** Slide end time */
    const END_TIME = 'end_time';

    /** First block link URL */
    const FIRST_LINK = 'slide_link';

    /** First block link text */
    const FIRST_LINK_TEXT = 'slide_link_text';

    /** First block title */
    const FIRST_DISPLAY_TITLE = 'display_title';

    /** First block text */
    const FIRST_TEXT = 'slide_text';

    /** First block iframe URL */
    const FIRST_EMBED_CODE = 'embed_code';

    /** First block text position */
    const FIRST_TEXT_POSITION = 'slide_text_position';

    /** First block width class */
    const WIDTH_CLASS = 'slide_width_class';

    /** Second block desktop image location */
    const SECOND_DESKTOP_IMAGE = 'desktop_image_2';

    /** Second block mobile image location */
    const SECOND_MOBILE_IMAGE = 'mobile_image_2';

    /** Second block link URL */
    const SECOND_LINK = 'slide_link_2';

    /** Second block link text */
    const SECOND_LINK_TEXT = 'slide_link_text_2';

    /** Second block title */
    const SECOND_DISPLAY_TITLE = 'display_title_2';

    /** Second block text */
    const SECOND_TEXT = 'slide_text_2';

    /** Second block iframe URL */
    const SECOND_EMBED_CODE = 'embed_code_2';

    /** Second block text position */
    const SECOND_TEXT_POSITION = 'slide_text_position_2';

    /** Third block desktop image location */
    const THIRD_DESKTOP_IMAGE = 'desktop_image_3';

    /** Third block mobile image location */
    const THIRD_MOBILE_IMAGE = 'mobile_image_3';

    /** Third block link URL */
    const THIRD_LINK = 'slide_link_3';

    /** Third block link text */
    const THIRD_LINK_TEXT = 'slide_link_text_3';

    /** Third block title */
    const THIRD_DISPLAY_TITLE = 'display_title_3';

    /** Third block text */
    const THIRD_TEXT = 'slide_text_3';

    /** Third block iframe URL */
    const THIRD_EMBED_CODE = 'embed_code_3';

    /** Third block text position */
    const THIRD_TEXT_POSITION = 'slide_text_position_3';

    /**
     * Get slide ID
     * @return int
     */
    public function getId();

    /**
     * Get parent slider ID
     * @return int
     */
    public function getSliderId();

    /**
     * Get slide title
     * @return string
     */
    public function getTitle();

    /**
     * Get first block desktop image location
     * @return string
     */
    public function getFirstDesktopImageLocation();

    /**
     * Get first block mobile image location
     * @return string
     */
    public function getFirstMobileImageLocation();

    /**
     * Check if slide is active
     * @return bool
     */
    public function getIsActive();

    /**
     * Get slide position
     * @return int
     */
    public function getPosition();

    /**
     * Get slide start time (datetime)
     * @return string
     */
    public function getStartTime();

    /**
     * Get slide end time (datetime)
     * @return string
     */
    public function getEndTime();

    /**
     * Get first block link location
     * @return string
     */
    public function getFirstLink();

    /**
     * Get first block link text
     * @return string
     */
    public function getFirstLinkText();

    /**
     * Get first block title
     * @return string
     */
    public function getFirstTitle();

    /**
     * Get first block text
     * @return string
     */
    public function getFirstText();

    /**
     * Get first block iframe URL
     * @return string
     */
    public function getFirstEmbedCode();

    /**
     * Get first block text position
     * @return int
     */
    public function getFirstTextPosition();

    /**
     * Get first block width class
     * @return string
     */
    public function getWidthClass();

    /**
     * Get second block desktop image location
     * @return string
     */
    public function getSecondDesktopImageLocation();

    /**
     * Get second block mobile image location
     * @return string
     */
    public function getSecondMobileImageLocation();

    /**
     * Get second block link location
     * @return string
     */
    public function getSecondLink();

    /**
     * Get second block link text
     * @return string
     */
    public function getSecondLinkText();

    /**
     * Get second block title
     * @return string
     */
    public function getSecondTitle();

    /**
     * Get second block text
     * @return string
     */
    public function getSecondText();

    /**
     * Get second block iframe URL
     * @return string
     */
    public function getSecondEmbedCode();

    /**
     * Get second block text position
     * @return int
     */
    public function getSecondTextPosition();

    /**
     * Get third block desktop image location
     * @return string
     */
    public function getThirdDesktopImageLocation();

    /**
     * Get third block mobile image location
     * @return string
     */
    public function getThirdMobileImageLocation();

    /**
     * Get third block link location
     * @return string
     */
    public function getThirdLink();

    /**
     * Get third block link text
     * @return string
     */
    public function getThirdLinkText();

    /**
     * Get third block title
     * @return string
     */
    public function getThirdTitle();

    /**
     * Get third block text
     * @return string
     */
    public function getThirdText();

    /**
     * Get third block iframe URL
     * @return string
     */
    public function getThirdEmbedCode();

    /**
     * Get third block text position
     * @return int
     */
    public function getThirdTextPosition();

    /**
     * Get first block desktop image URL
     * @param bool $isSecureUrl
     * @return string
     */
    public function getFirstDesktopImageUrl($isSecureUrl);

    /**
     * Get first block mobile image URL
     * @param bool $isSecureUrl
     * @return string
     */
    public function getFirstMobileImageUrl($isSecureUrl);

    /**
     * Get second block desktop image URL
     * @param bool $isSecureUrl
     * @return string
     */
    public function getSecondDesktopImageUrl($isSecureUrl);

    /**
     * Get second block mobile image URL
     * @param bool $isSecureUrl
     * @return string
     */
    public function getSecondMobileImageUrl($isSecureUrl);

    /**
     * Get third block desktop image URL
     * @param bool $isSecureUrl
     * @return string
     */
    public function getThirdDesktopImageUrl($isSecureUrl);

    /**
     * Get third block mobile image URL
     * @param bool $isSecureUrl
     * @return string
     */
    public function getThirdMobileImageUrl($isSecureUrl);

    /**
     * Set slide ID
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set parent slider ID
     * @param int $sliderId
     * @return $this
     */
    public function setSliderId($sliderId);

    /**
     * Set slide title
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set first block desktop image location
     * @param string $image
     * @return $this
     */
    public function setFirstDesktopImageLocation($image);

    /**
     * Set first block mobile image location
     * @param string $image
     * @return $this
     */
    public function setFirstMobileImageLocation($image);

    /**
     * Set slide is active flag
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive);

    /**
     * Set slide position
     * @param int $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * Set slide start time
     * @param string $startTime
     * @return $this
     */
    public function setStartTime($startTime);

    /**
     * Set slide end time
     * @param string $endTime
     * @return $this
     */
    public function setEndTime($endTime);

    /**
     * Set first block link location
     * @param string $link
     * @return $this
     */
    public function setFirstLink($link);

    /**
     * Set first block link text
     * @param string $text
     * @return $this
     */
    public function setFirstLinkText($text);

    /**
     * Set first block title
     * @param string $title
     * @return $this
     */
    public function setFirstTitle($title);

    /**
     * Set first block text
     * @param string $text
     * @return $this
     */
    public function setFirstText($text);

    /**
     * Set first block iframe URL
     * @param string $embedCode
     * @return $this
     */
    public function setFirstEmbedCode($embedCode);

    /**
     * Set first block text position
     * @param int $position
     * @return $this
     */
    public function setFirstTextPosition($position);

    /**
     * Set first block width class
     * @param string $widthClass
     * @return $this
     */
    public function setWidthClass($widthClass);

    /**
     * Set second block desktop image location
     * @param string $image
     * @return $this
     */
    public function setSecondDesktopImageLocation($image);

    /**
     * Set second block mobile image location
     * @param string $image
     * @return $this
     */
    public function setSecondMobileImageLocation($image);

    /**
     * Set second block link location
     * @param string $link
     * @return $this
     */
    public function setSecondLink($link);

    /**
     * Set second block link text
     * @param string $text
     * @return $this
     */
    public function setSecondLinkText($text);

    /**
     * Set second block title
     * @param string $title
     * @return $this
     */
    public function setSecondTitle($title);

    /**
     * Set second block text
     * @param string $text
     * @return $this
     */
    public function setSecondText($text);

    /**
     * Set second block iframe URL
     * @param string $embedCode
     * @return $this
     */
    public function setSecondEmbedCode($embedCode);

    /**
     * Set second block text position
     * @param int $position
     * @return $this
     */
    public function setSecondTextPosition($position);

    /**
     * Set third block desktop image location
     * @param string $image
     * @return $this
     */
    public function setThirdDesktopImageLocation($image);

    /**
     * Set third block mobile image location
     * @param string $image
     * @return $this
     */
    public function setThirdMobileImageLocation($image);

    /**
     * Set third block link location
     * @param string $link
     * @return $this
     */
    public function setThirdLink($link);

    /**
     * Set third block link text
     * @param string $text
     * @return $this
     */
    public function setThirdLinkText($text);

    /**
     * Set third block title
     * @param string $title
     * @return $this
     */
    public function setThirdTitle($title);

    /**
     * Set third block text
     * @param string $text
     * @return $this
     */
    public function setThirdText($text);

    /**
     * Set third block iframe URL
     * @param string $embedCode
     * @return $this
     */
    public function setThirdEmbedCode($embedCode);

    /**
     * Set third block text position
     * @param int $position
     * @return $this
     */
    public function setThirdTextPosition($position);
}
