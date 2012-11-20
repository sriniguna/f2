=== F2 ===
Contributors: SriniG
Tags: blue, brown, green, dark, one-column, two-columns, three-columns, left-sidebar, right-sidebar, flexible-width, custom-menu, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready
Requires at least: 3.4
Tested up to: 3.5-beta-3
Stable tag: 2.0
License: GNU General Public License
License URI: license.txt

F2 is a light-weight, responsive theme for WordPress.

== Description ==

*Please Note: Version 2.0 is a massive update. If you are using an older version of the theme, mind that you will have to redefine all your customizations when you upgrade, this is the case even if you are using a child theme. If you have too many customizations, you may want to stick with the older version. If for any reason you want to revert back to the older version of the theme, you can download v1.2 from the [theme's home page](http://srinig.com/wordpress/themes/f2/). Version 2.0 requires WordPress 3.4 or above.*

**Main Features**

* Responsive. This means certain elements of the site gets rearraged and/or resized so that the layout nicely fits the screen the site is viewed in. The site looks good whether you are looking at it from a mobile phone or a tablet device or a widescreen monitor.
* Four color schemes:
	* Blue (default)
	* Brown
	* Green
	* Dark
* Four different layouts to choose from:
	* content - sidebar (default)
	* sidebar - content
	* sidebar - content - sidebar
	* content only (no sidebar)
* More customization possible from the 'Theme Options' admin page and also from the WP 'Theme Customizer'.
* Compatible with WordPress version 3.4 and above. Tested upto 3.5-beta-3.
* HTML5 and CSS3.
* Tested and works well in all major browsers. IE 7 and up, and the latest versions of Chrome, Firefox, Opera and Safari.
* Translation ready.
* Licensed under the GPL.


== Installation ==

**Manual installation**

1. After downloading the compressed file (named `f2.zip` or similar), uncompress the file and the Upload the `f2` folder to the `/wp-content/themes/` directory in your web server
2. Activate the theme by selecting the F2 theme from 'Appearance' -> 'Themes' in WordPress admin area
3. Customize the theme from 'Appearance' -> 'Theme Options'

**Installation from WordPress Admin**

1. In the WordPress admin area, go to 'Appearance' -> 'Themes' and then click on the 'Install Themes'.
2. Search for 'f2', the latest version of the theme shows up if it's available in the WP theme directory. Alternatively, you can upload the zipped file that's been downloaded.
3. Click 'Install Now'
4. Activate the theme by selecting the F2 theme from 'Appearance' -> 'Themes' in WordPress admin area
5. Customize the theme from 'Appearance' -> 'Theme Options'

After following the above steps, go to the front end and you'll find your website sporting the F2 theme.

== Internationalization ==

For a complete list of languages the theme has been translated into, please refer to the [theme home page](http://srinig.com/wordpress/themes/f2/)

Please note that most of the translations pertain to the older versions of the theme, and the newer versions, notably F2 v2.0, has many strings that has not been translated yet. You can contribute by translating the theme in your language or updating incomplete translations.

= Translating the theme =

The translation template file is named `f2.pot` and is located in the `languages` directory. The resulting PO and MO files should go in the `languages` directory, and should be named in the format `xx_YY.po` and `xx_YY.mo` files respectively. Where xx refers to the language code and YY to the locale. For example, the German translation files will have the name `de_DE.po` and `de_DE.mo`. This xx_YY should be the same as the value you define for WPLANG in wp-config.php.

You can use an application like [poEdit](http://www.poedit.net/) to translate the theme, or just translate the strings in the f2.pot file and send it to the theme author. All translations sent to the author will be bundled with the next version of the theme.

You may want to have a look at: [Translating WordPress on codex](http://codex.wordpress.org/Translating_WordPress)

== Notes ==

= The 'Two Sidbars' layout option =

The theme has a setting named 'Layout' with four options, viz., 'One Sidebar (Right)', 'One Sidebar (Left)', 'Two Sidebars', and 'No Sidebar', the first option being default.

When the 'Two Sidebars' option is selected, the main sidebar is displayed on the *left hand side*, and one more sidebar is added on the right hand side.

= Sidebar re-arrangement for different screen widths =

The theme is responsive, certain elements of the site gets rearraged and/or resized so that the layout nicely fits the screen. The sidebar(s) fall below the main content area when the site is viewed on smaller screen widths, this is normal behaviour. Also, even when the two sidebar layout is selected, the three column layout comes alive only when the screen width is sufficiently wide. This 'sufficient width' is even greater when sidebar width is 'large' (so it's not a good idea to choose 'two sidebar' and 'wide' sidebar layout). At screen widths less than the 'sufficient width', both the sidebars combine to form one single sidebar and shown on the left hand side.

= Archives page =

You can have an archives page that will list links to all your categories, tags and monthly archive pages. Create a new page with a name like 'Archives', choose the template 'Archives', leave the page blank, and publish the page.

= Fonts =

The theme uses Google Fonts [Bitter](http://www.google.com/webfonts/specimen/Bitter) and [Gudea](http://www.google.com/webfonts/specimen/Gudea).

== Support ==

Please use the [WordPress support forums](http://wordpress.org/support/theme/f2/) for feedback and support. Translations can be sent to srinig.com@gmail.com.

== Changelog ==

= 2.0 =
This is a major update. The theme is completely overhauled and rewritten from scratch based on the _s theme. This version requires WP 3.4 or above.

Most of the things have been modified. The following is the list of main additions and removals.

**Additions**

* Responsiveness
* Support for the 'post thumbnail' feature
* Support for 'aside' post format
* Customization using the interactive WP customizer interface
* New options (and options that have undergone a complete change)
	* Color schemes
	* Logo image
	* Header image
	* Layout choices
	* Sidebar width
	* Sidebar font size
	* Content font size
	* Option to show only excerpts (instead of full posts) in home page
	* Custom CSS

**Removals**

* Links template
* Options:
	* Header bg color
	* Header bg image and related options
	* Header text color

Changelog for earlier versions can be found at the [theme home page](http://srinig.com/wordpress/themes/f2/).

== Upgrade Notice ==
= 2.0 =
F2 version 2.0 is a massive update, a complete overhaul. If you are using an older version of the theme, mind that you will have to redefine all your customizations when you upgrade, this is the case even if you are using a child theme. If you have too many customizations, you may want to stick with the older version. Version 2.0 requires WordPress 3.4 or above.