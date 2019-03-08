/**
 * Scandiweb_Slider
 *
 * @category    Scandiweb
 * @package     Scandiweb_Slider
 * @author      Artis Ozolins <artis@scandiweb.com>
 * @copyright   Copyright (c) 2016 Scandiweb, Ltd (http://scandiweb.com)
 */

define([
    'jquery',
    'jquery/ui'
],function($) {

    "use strict";
    $.widget('scandiweb.sliderProducts', {

        options: {},

        _create: function() {

            var mapArea = this.element.find('area');

            mapArea.each(function(i, el) {
                var area = $(el),
                    productBlockId = '#' + $(el).data('product-block-id'),
                    productBlock = $(productBlockId),
                    productUrl = productBlock.data('product-url'),
                    slider = $('#' + this.options.sliderId);

                area.attr('href', productUrl);

                area.mousemove(function(e) {
                    productBlock.offset({
                        'top': e.pageY - 50 - productBlock.height(),
                        'left': e.pageX - 50 - productBlock.width()
                    })
                });

                area.mouseover(function() {
                    productBlock.css({
                        'display': 'block',
                        'position': 'absolute'
                    });

                    slider.slick('slickPause');
                });

                area.mouseleave(function() {
                    slider.slick('slickPlay');
                    productBlock.css('display', 'none');
                });
            }.bind(this));
        }
    });

    return $.scandiweb.sliderProducts;
});
