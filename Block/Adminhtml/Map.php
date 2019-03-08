<?php
/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */
namespace Scandiweb\Slider\Block\Adminhtml;

class Map extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'Scandiweb_Slider';
        $this->_controller = 'adminhtml_map';

        parent::_construct();

        if ($this->getRequest()->getParam('ajax') || !$this->_request->getParam('slide_id')) {
            $this->removeButton('add');
        }
    }

    /**
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl(
            'slideradmin/map/new',
            ['slide_id' => $this->_request->getParam('slide_id')]
        );
    }
}
