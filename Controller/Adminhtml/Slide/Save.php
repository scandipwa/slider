<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @author      Raivis Dejus <info@scandiweb.com>
 * @copyright   Copyright (c) 2018 Scandiweb, Ltd (https://scandiweb.com)
 */
namespace Scandiweb\Slider\Controller\Adminhtml\Slide;

class Save extends \Magento\Backend\App\Action
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Scandiweb_Slider::slide_save');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $images['desktop_image'] = $this->getRequest()->getParam('desktop_image');
        $images['mobile_image'] = $this->getRequest()->getParam('mobile_image');
        $images['desktop_image_2'] = $this->getRequest()->getParam('desktop_image_2');
        $images['mobile_image_2'] = $this->getRequest()->getParam('mobile_image_2');
        $images['desktop_image_3'] = $this->getRequest()->getParam('desktop_image_3');
        $images['mobile_image_3'] = $this->getRequest()->getParam('mobile_image_3');

        /* @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            /* @var \Scandiweb\Slider\Model\Slide $model */
            $model = $this->_objectManager->create('Scandiweb\Slider\Model\Slide');

            $model->setData($data);

            $imageKeys = [
                'desktop_image',
                'mobile_image',
                'desktop_image_2',
                'mobile_image_2',
                'desktop_image_3',
                'mobile_image_3'
            ];

            try {

                foreach ($imageKeys as $imageKey) {
                    if (isset($_FILES[$imageKey]['name']) && $_FILES[$imageKey]['name']) {
                        /* @var \Magento\MediaStorage\Model\File\Uploader $uploader */
                        $uploader = $this->_objectManager->create(
                            'Magento\MediaStorage\Model\File\Uploader',
                            ['fileId' => $imageKey]
                        );
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                        /* @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                        $imageAdapter = $this->_objectManager->get('Magento\Framework\Image\AdapterFactory')->create();

                        $uploader->addValidateCallback($imageKey, $imageAdapter, 'validateUploadFile')
                            ->setAllowRenameFiles(true)
                            ->setFilesDispersion(true);

                        /* @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
                        $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                            ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                        $result = $uploader->save(
                            $mediaDirectory->getAbsolutePath(\Scandiweb\Slider\Model\Slider::MEDIA_PATH)
                        );
                        // Resize images for use in srcSets
                        $model->prepareImagesForSrcset($result['path'] . $result['file']);

                        $model->setData($imageKey, \Scandiweb\Slider\Model\Slider::MEDIA_PATH . $result['file']);
                    } elseif (isset($images[$imageKey]['delete']) && $images[$imageKey]['delete']) {
                        $model->setData($imageKey, null);
                    } else {
                        // Nothing changed, removing from the data to change
                        $model->unSetData($imageKey);
                    }
                }

                $model->save();
                $this->messageManager->addSuccess(__('Slide successfully saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['slide_id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('slideradmin/slider/edit', ['slider_id' => $model->getSliderId()]);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the slide.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['slide_id' => $this->getRequest()->getParam('slide_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
