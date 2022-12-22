<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Controller\Adminhtml\Slide;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\LayoutFactory;

class Maps extends Action
{
    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @param Context $context
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        LayoutFactory $layoutFactory
    )
    {
        parent::__construct($context);

        $this->layoutFactory = $layoutFactory;
    }

    public function execute()
    {
        $resultPage = $this->layoutFactory->create();

        return $resultPage;
    }
}
