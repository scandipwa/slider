<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Helper;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    /**
     * @var UrlInterface
     */
    protected $_backendUrl;

    /**
     * @param Context $context
     * @param UrlInterface $backendUrl
     */
    public function __construct(
        Context $context,
        UrlInterface $backendUrl
    ) {
        parent::__construct($context);

        $this->_backendUrl = $backendUrl;
    }

    /**
     * @return string
     */
    public function slidesGridUrl()
    {
        return $this->_backendUrl->getUrl('*/*/slides', ['_current' => true]);
    }

    /**
     * @return string
     */
    public function mapGridUrl()
    {
        return $this->_backendUrl->getUrl('*/*/maps', ['_current' => true]);
    }
}
