<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

namespace Scandiweb\Slider\Controller\Adminhtml\Slider;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Scandiweb\Slider\Api\SliderRepositoryInterface;
use Scandiweb\Slider\Model\SliderFactory;

class Edit extends Action
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var SliderRepositoryInterface
     */
    protected $sliderRepository;

    /**
     * @var SliderFactory
     */
    protected $sliderFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param SliderRepositoryInterface $sliderRepository
     * @param SliderFactory $sliderFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        SliderRepositoryInterface $sliderRepository,
        SliderFactory $sliderFactory
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->sliderRepository = $sliderRepository;
        $this->sliderFactory = $sliderFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slider_save');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('slider_id');
        $slider = null;

        if ($id) {
            try {
                /** @var \Scandiweb\Slider\Model\Slider $slider */
                $slider = $this->sliderRepository->get($id);
            } catch (NoSuchEntityException $e) {
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                $this->messageManager->addErrorMessage(__('This slide no longer exists.'));

                return $resultRedirect->setPath('*/*/');
            }
        } else {
            /** @var \Scandiweb\Slider\Model\Slider $slider */
            $slider = $this->sliderFactory->create();
        }

        $data = $this->_getSession()->getFormData(true);

        if (!empty($data)) {
            $slider->setData($data);
        }

        $this->_coreRegistry->register('slider', $slider);

        return $this->resultPageFactory->create();
    }
}
