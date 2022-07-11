/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'lineheight';
    config.allowedContent = true;
    config.contentsCss = 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap';
    config.font_names = config.font_names + 'Open Sans 1/Exo 2;';
    config.font_names = config.font_names + 'Open Sans /Open Sans;';
};
