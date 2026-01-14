/**
 * External dependencies
 */
import A11yCookieYes from '@yardinternet/a11y-cookie-yes';
import {
	A11yFacetWP,
	A11yMobileMenu,
	FocusStyle,
	WebShareApi,
	EnhanceExternalLinks,
} from '@yardinternet/brave-frontend-kit';

/**
 * Internal dependencies
 */
import Accordion from './components/Accordion';
import Cards from './components/Cards';
import Dialog from './components/Dialog';
import Navigation from './components/Navigation';
import SearchBar from './components/SearchBar';

/**
 * Application entrypoint
 */
window.addEventListener( 'DOMContentLoaded', () => {
	A11yCookieYes.getInstance();
	new A11yFacetWP();
	new A11yMobileMenu();
	Accordion();
	Cards();
	Dialog();
	new FocusStyle();
	Navigation();
	SearchBar();
	new WebShareApi();
} );

// Enhance External Links
new EnhanceExternalLinks( {
 selector: '.main a',
 icon: '<i class="fa-regular fa-up-right-from-square mx-2"></i>',
 excludedClasses: [ 'wp-block-button__link', 'banner-button' ],
 excludedUrlKeywords: [ 'openpdc' ],
} );