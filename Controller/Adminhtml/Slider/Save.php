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
use Scandiweb\Slider\Api\SliderRepositoryInterface;
use Scandiweb\Slider\Model\SliderFactory;

class Save extends Action
{
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
     * @param SliderRepositoryInterface $sliderRepository
     * @param SliderFactory $sliderFactory
     */
    public function __construct(
        Context $context,
        SliderRepositoryInterface $sliderRepository,
        SliderFactory $sliderFactory
    ) {
        parent::__construct($context);

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
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getParam('slider');

        if ($data) {
            $id = $this->getRequest()->getParam('slider_id');
            $slider = null;

            if ($id) {
                try {
                    /** @var \Scandiweb\Slider\Model\Slider $slider */
                    $slider = $this->sliderRepository->get($id);
                } catch (NoSuchEntityException $e) {
                    /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                    $resultRedirect = $this->resultRedirectFactory->create();
                    $this->messageManager->addErrorMessage(__('This slider no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                /** @var \Scandiweb\Slider\Model\Slider $slider */
                $slider = $this->sliderFactory->create();
            }

            $slider->setData($data);

            try {
                $this->sliderRepository->save($slider);

                $this->messageManager->addSuccessMessage(__('Slider successfully saved.'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [
                        'slider_id' => $slider->getId(),
                        '_current' => true
                    ]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the slider.')
                );
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', [
                'slider_id' => $this->getRequest()->getParam('slider_id')
            ]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
