<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml\Grid\Column;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /* @var \Magento\Store\Model\StoreManagerInterface */
    protected $_storeManager;

    /**
     * @param \Magento\Backend\Block\Context              $context
     * @param \Magento\Store\Model\StoreManagerInterface  $storeManager
     * @param array                                       $data
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @param string $imageKey
     * @return boolean|string
     */
    private function getImageUrl(\Magento\Framework\DataObject $row, $imageKey)
    {
        $image = $row->getData($imageKey);

        if ($image) {
            return $this->_storeManager->getStore()->getBaseUrl(
                    \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                ) . $row->getData($imageKey);
        }

        return false;
    }

    /**
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $desktopImage = $this->getImageUrl($row, 'desktop_image');
        $mobileImage = $this->getImageUrl($row, 'mobile_image');
        $desktopImage2 = $this->getImageUrl($row, 'desktop_image_2');
        $mobileImage2 = $this->getImageUrl($row, 'mobile_image_2');
        $desktopImage3 = $this->getImageUrl($row, 'desktop_image_3');
        $mobileImage3 = $this->getImageUrl($row, 'mobile_image_3');

        $result = '';

        if ($desktopImage) {
            $result .= '<image width="100%" style="max-width: 100px;"  src="'.$desktopImage.'">';
        }

        if ($mobileImage) {
            $result .= '<image width="100%" style="max-width: 100px;"  src="'.$mobileImage.'">';
        }

        if ($desktopImage2) {
            $result .= '<image width="100%" style="max-width: 100px;"  src="'.$desktopImage2.'">';
        }

        if ($mobileImage2) {
            $result .= '<image width="100%" style="max-width: 100px;"  src="'.$mobileImage2.'">';
        }

        if ($desktopImage3) {
            $result .= '<image width="100%" style="max-width: 100px;"  src="'.$desktopImage3.'">';
        }

        if ($mobileImage3) {
            $result .= '<image width="100%" style="max-width: 100px;"  src="'.$mobileImage3.'">';
        }


        return $result;
    }
}
