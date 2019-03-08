/**
 * @category    Scandiweb
 * @package     Scandiweb/Slider
 * @author      Rihards Ratke <info@scandiweb.com>
 * @copyright   Copyright (c) 2018 Scandiweb, Inc (https://scandiweb.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0 (OSL-3.0)
 */

/*jshint browser:true jquery:true*/
/*global alert*/
define([
    'jquery',
    'jquery/ui',
    'Scandiweb_Slider/js/canvas-area-draw',
    'domReady!'
], function ($) {
    $.widget('scandi.canvas', {
        options: {
            classes: {
                coordinatesInput: $('#coordinates'),
                imageLocation: $('#image_location')
            }
        },

        /**
         * Will allow user to draw map
         *
         * @private
         */
        _init: function () {
            var self = this,
                coordinatesInput = self.options.classes.coordinatesInput,
                imageLocation = self.options.classes.imageLocation;

            coordinatesInput.attr('data-image-url', imageLocation.val()).canvasAreaDraw({
                imgUrl: imageLocation.val()
            });
        }
    });

    return $.scandi.canvas;
});