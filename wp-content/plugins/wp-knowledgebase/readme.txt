=== WordPress Knowledge base & Documentation Plugin - WP Knowledgebase ===
Contributors: iova.mihai, EnigmaWeb, helgatheviking, sormano, Base29, macbookandrew
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=CEJ9HFWJ94BG4
Tags: WP Knowledgebase, knowledgebase, knowledge base, faqs, wiki
Requires at least: 4.7
Tested up to: 5.5.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple and flexible knowledge base & documentation plugin for WordPress. Reduce customer support in days with great documentation.

== Description ==

Create an attractive and professional knowledge base or documentation. WP Knowledgebase is easy to use, easy to customize, and works with any theme.

= Why is a knowledge base important? =

* **Often, people prefer self-service** - People often try to find answers on their own before contacting for help. A knowledgebase is where they look first.
* **A knowledge base operates 24/7** - Even if you have a distributed team, a knowledgebase will always be there for your users.
* **A knowledge base acts like a brain for your support team** - Your team members won't know everything other team members know. A knowledgebase can bridge that gap and offer your team.
* **It can lower costs** - With standardized answers and all the information in one place, a knowledgebase can ensure new hires are trained quicker and better.

= Key Features =

* Simple and easy to use documentation plugin
* Fully RESPONSIVE knowledge base template files
* Customise your catalogue presentation easily (choose theme colour, sidebar layouts, number of knowledge base articles to show etc)
* Super fast search, with predictive text - handy!
* A selection of sidebar widgets (search, categories, tags, posts)
* Integrated documentation breadcrumbs (on/off)
* Display comments on knowledge base articles (on/off)
* Drag & Drop for custom ordering of documentation articles and categories
* Works across all major browsers and devices - IE8+, Safari, Firefox, Chrome
* Editable slug (default is /knowledge base )

= Premium Features =

[WP Knowledgebase PRO](https://usewpknowledgebase.com/) is a paid-upgrade to WP Knowledgebase which makes your mouth water with [these delicious documentation features](https://usewpknowledgebase.com/):

* **Search Analytics** - Understand what users are searching for on your documentation website. View each individual knowledge base search query and also the most popular searches.
* **Article Feedback (coming soon)** - Let your users offer feedback on your knowledge base articles. They can vote and offer feedback directly from the documentation articles.
* **Related Documentation Articles (coming soon)** - Guide your users through the knowledge base. Add a list of related documentation articles at the bottom of an article, so your users always have access to answers.
* **Content Restriction** - Set up a private knowledge base or wiki with just a few clicks. Restrict access to your knowledge base content. Allow access to your documentation only to certain user roles or individual users.

Improve your documentation with [WP Knowledgebase PRO](https://usewpknowledgebase.com/) now!

= Important =

On activation, the plugin will create a page called "Knowledgebase" and on that page there will be the shortcode `[kbe_knowledgebase]`. If you want to change the slug of that page do so via the WP Knowledgebase settings.

= Advanced Customisation =

Developers, you can completely customise the way the WP Knowledgebase displays by copying the plugin templates to your theme and customising them there. You may be familiar with this method of templating as used by WooCommerce.

In the plugin's root directory you will find a folder called `template`. You can override that folder and any of the files within, by copying them into your active theme and renaming the folder to `/yourtheme/wp_knowledgebase`. WP Knowledgebase plugin will automatically load any template files you have in that folder in your theme, and use them instead of its default template files. If no such folder or files exist in your theme, it will use the ones from the plugin.

This is the safest way to customise the WP Knowledebase templates, as it means that your changes will not be overwritten when the plugin updates.

= Official Demo =

* [Click here](http://demo.enigmaweb.com.au/knowledgebase/) for out-of-the-box demo

= User Examples =

* [WP Booking System](https://www.wpbookingsystem.com/plugin-documentation/) documentation

= Need help? =

Have any questions, bug reports or feature requests? Please [contact us here](https://usewpknowledgebase.com/contact/)

= Languages =

English, German, Dutch, Blugarian, Spanish - Spain, Spanish - USA, Spanish - Puerto Rico, Brazilian Portaguese, Swedish, Polish and Indonesian.

Translators, thank you all for your contribution to this plugin. Much appreciated. If you'd like to help translate this plugin into your language please get in touch. It's very easy - you don't have to know any code and it's a great way to contribute to the WordPress community.


== Installation ==

1. Upload the `wp-knowledgebase` folder to the `/wp-content/plugins/` directory or install it from the plugin directory via your Plugins dash.
1. Activate the WP Knowledgebase plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by going to the `Knowledgebase` tab that appears in your admin menu.

= Important =

On activation, the plugin will create a page called "Knowledgebase" and on that page there will be the shortcode `[kbe_knowledgebase]`. If you want to change the slug of that page do so via the WP Knowledgebase settings.

= Advanced Customisation =

Developers, you can completely customise the way the WP Knowledgebase displays by copying the plugin templates to your theme and customising them there. You may be familiar with this method of templating as used by WooCommerce.

In the plugin's root directory you will find a folder called `template`. You can override that folder and any of the files within, by copying them into your active theme and renaming the folder to `/yourtheme/wp_knowledgebase`. WP Knowledgebase plugin will automatically load any template files you have in that folder in your theme, and use them instead of its default template files. If no such folder or files exist in your theme, it will use the ones from the plugin.

This is the safest way to customise the WP Knowledebase templates, as it means that your changes will not be overwritten when the plugin updates.
 
== Frequently Asked Questions ==

= I'm getting a 404 error =

Please go to Settings > Permalinks and resave your permalink structure.

= Can I add the documentation search bar to my theme template manually? =

Yes, use this php snippet `<?php kbe_search_form(); ?>`

= Can users vote on articles? Like a thumbs up/down thing? =

This feature is not built into the plugin, however you can use another plugin to achieve this easily. I recommend [WTI Like Post](https://wordpress.org/plugins/wti-like-post/)

= How can I customise the design? =

You can do some basic presentation adjustments via Knowledgebase > Settings.

Developers, you can completely customise the way the WP Knowledgebase displays by copying the plugin templates to your theme and customising them there. You may be familiar with this method of templating as used by WooCommerce.

In the plugin's root directory you will find a folder called `template`. You can override that folder and any of the files within, by copying them into your active theme and renaming the folder to `/yourtheme/wp_knowledgebase`. WP Knowledgebase plugin will automatically load any template files you have in that folder in your theme, and use them instead of its default template files. If no such folder or files exist in your theme, it will use the ones from the plugin.

This is the safest way to customise the WP Knowledebase templates, as it means that your changes will not be overwritten when the plugin updates.

= It does not look good on my theme =

Please check that the shortcode `[kbe_knowledgebase]` is added on the Knowledgebase main page.  You can tweak the design using CSS in your theme. Or for more advanced customisation see previous point.

= Can I control privacy or content restrictions for WP Knowledgebase categories and posts? =

Yes. Any content restriction solution that is compatible with Custom Post Types should work with WP Knowledgebase.

= Can I use WP Knowledgebase in my Language? =

Yes, the plugin is internationalized and ready for translation. If you would like to help with a translation please [contact me](http://www.enigmaweb.com.au/contact)
You can also use it WPML. After installing and activating both plugins, go to WPML > Translation Management > Multilangual Content Setup > scroll all the way down > tick the checkbox 'custom posts' and 'custom taxanomies' for this post type, set to 'Translate'.

= Can import/export WP Knowledgebase data? =

Yes. You can import/export data using the built in WordPress function via Tools. It may not import any images in use (although it will import the file paths) so you will need to copy across any images from your old site to the new site uploads folder via FTP. If images still appear broken or missing then you might need to run a search and replace tool to correct the image filepaths for your new site.

= Where can I get support for this plugin? =

If you've tried all the obvious stuff and it's still not working please request support via the forum.


== Screenshots ==

1. An example of WP Knowledgebase in action, main knowledge base home view
2. Another example of WP Knowledgebase front-end, documentation article view
3. The settings screen in WP-Admin for WP Knowledgebase
4. Available knowledge base widgets

== Changelog ==

**Important notice** - Version 1.3.0 is a major update. Make a full site backup and [click here to learn more](https://usewpknowledgebase.com/blog/new-template-system/) before upgrading.

= 1.3.4 =
* New: Added [kbe_breadcrumbs] and [kbe_live_search] documentation shortcodes.
* Fixed: Sorting documentation articles and categories not working.
* Misc: Documentation article icons style no longer depends on knowledge base wrapper.

= 1.3.3 =
* Fixed: Issue with image upload not working in media library because of WP Knowledgebase.
* Fixed: Issue with documentation main page not showing sidebar.

= 1.3.2 =
* Fixed: Issue with knowledge base Getting Started admin page taking over other admin pages.

= 1.3.1 =
* New: Added the "kbe_live_search_results_count" filter to modify the live search documentation articles results.
* New: Added "wp_knowledgebase" JavaScript global variable to knowledge base pages on front-end.
* New: Added a Getting Started admin page to help you better understand how documentation pages work.
* Fixed: Compatibility issues for documentation pages with Twenty Nineteen theme.
* Fixed: Issue with SVG icons on documentation pages on certain themes.

= 1.3.0 =
* New: Introducing a new template system for the knowledge base's front-end.
* Misc: Refactored admin pages.

= 1.2.5 =
* Misc: Patch release for future 1.3.0 major update.

= 1.2.4 =
* New: Added Danish language.
* Misc: Updated main translation files.
* Misc: Refactoring of main plugin file.

= 1.2.3 =
* New: Added option to disable output of CSS in knowledge base files.
* Enhancement: Removed unwanted H1 heading from knowledge base archive and shortcode template files.
* Fixed: JSON error when saving page with knowledge base shortcode.

= 1.2.2 =
* Enhancement: Updated the design for the Order and Settings admin pages to match the latest version of WordPress.
* New: Added option to show the knowledgebase article’s excerpt, alongside the article’s title, in the live search results.
* New: Added option to customize the knowledgebase's placeholder text for the search input field.
* New: Added option to customize the message shown to users when a search query doesn’t return any articles.
* New: Added option to customize the knowledgebase's breadcrumbs items separator.

= 1.2.1 =
* Fixed: Knowledgebase page not being created from admin notice.
* Enhancement: Small CSS fixes for better UI and UX.
* Misc: Added deactivation feedback form.

= 1.2.0 =
* Gutenberg compatibility added

= 1.1.9 =
* Search fix

= 1.1.8 =
* Adds support for the excerpt
* Uses the_excerpt in search results

= 1.1.7 =
* Fixes for Divi Theme

= 1.1.6 =
* CSS updates for responsive widths

= 1.1.5 =
* fix notice when activating plugin
* code consistency changes and cleanup structuring
* fix admin css filename
* fix notices on widgets when creating them + other tweaks/improvements
* never delete data without confirming
* widget fixes
* add direct access checks to all files
* enhance template files
* add template-functions.php
* improve how breadcrumbs are handled
* fix initial kb page on install
* use default theme comments template
* improve search
* remove unused functions
* improve code commenting
* move taxonomy sort order from admin-only functions file
* deafult settings sanitize callback
* fix german translation
* fix db prefixes 
* add migration class

= 1.1.4 = 
* Enqueue scripts & styles issue fixed.
* Minor typo fixed

= 1.1.3 = 
* custom Styles and Templates issue fixed.
* fixed +/- icon filepaths so they change properly

= 1.1.2 =
* fixed count issue on parent category
* fixed page title issue - it will now reflect page name rather than being stuck on "knowledgebase"
* fixed pluralization if there is only one article
* register stylesheet and JS and call only on KBE pages 
* only eneque and load search inline script if search is enabled
* move some scripts to footer for better performance
* only print inline styles if color is defined
* add admin notice if theme contains customized templates
* optimize images
* use get_stylesheet_directory instead of replacing built-in constant
* fixed a few typos

= 1.1.1 =
* fixed error warnings
* 'parent' => 0 removed from the terms array to fix reorder of subcategories
* Registered support for 'author'

= 1.1 =
* renames index.php to wp-knowledgebase.php
* no longer automatically copies template files to theme folder
* no longer deletes kbe template folder from theme
* fixes template redirect issue
* fixes search template issue
* uninstall.php is called automatically as of WP2.7
* no longer silences error_reporting
* no need to flush_rewrite_rules() 3 times
* updates widget registration
* adds optional custom headers/footers
* fix for undefined $i variable
* fixes conditional loading of scripts/styles
* sanitizes merge options
* some minor css fixes

= 1.0.9 =
* Replace TEMPLATEPATH with STYLESHEETPATH.
* Replace get_template_directory_uri() with get_stylesheet_directory_uri().

= 1.0.8 =
* Added strip_tags() function for excerpt for the search results.
* Query corrected for getting KBE title and fixing the activation error.
* Images path corrected in CSS

= 1.0.7 =
* CSS file path corrected.

= 1.0.6 =
* Update query corrected on order.

= 1.0.5 =
* Issue with child theme fixed.
* Function corrected for copying plugin template files in to active theme folder

= 1.0.4 =
* Breadcrumbs text issue fixed.
* Added support for Sub-Categories.
* Added support for child theme.
* Added support for multi site.
* Some Code Correction.
* Added support for revisions.
* Languages added

= 1.0.3 =
* Minor CSS Changes.
* Breadcrumbs link issue fixed.
* Truncate function removed from the titles 
* Function corrected for loading plugin text domain

= 1.0.2 =
* Translation issue fixed
* Miscellaneous minor fixes

= 1.0.1 =
* Function fixed which was assigning template to the page
* Theme styling issue fixed

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.3.0 =
1.3.0 is a major update. Make a full site backup and [click here to learn more](https://usewpknowledgebase.com/blog/new-template-system/) before upgrading.