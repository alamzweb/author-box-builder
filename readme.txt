=== Author Box Builder === \
Contributors: Saad
Plugin URI: https://sitecroftdev.vercel.app/plugins/author-box-builder
Tags: author box, profile card, biography, author bio, social links, profile widget, post author, user profile, gutenberg block, shortcode
Requires at least: 6.0
Tested up to: 6.5
Requires PHP: 8.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create highly customizable, beautifully structured author profile boxes equipped with custom social network integrations, avatar styling, and native blocks.

== Description == \

Author Box Builder is an advanced, featherweight, and production-ready WordPress management utility designed to showcase article contributors elegantly across your ecosystem. Engineered explicitly for performance-focused sites, the platform allows site administrators to construct comprehensive profile cards containing biographical summaries, website connections, and custom social network paths directly underneath content blocks.

Unlike standard bio configurations, Author Box Builder operates on a strict "Zero-Load" architecture. It introduces no external font dependencies, discards bulky script libraries, bypasses traditional heavy jQuery frameworks, and avoids injecting bloated layouts by defaulting to strict CSS Grid and Flexbox mechanics. It remains completely invisible on your site's frontend layout until you explicitly toggle target layout attachments, drop a lightweight shortcode, or place an interactive Gutenberg block inside your site-wide content stream.

= Performance Considerations = \
Assets are strictly loaded only when an active instance is being processed within the template hierarchy. This ensures your Core Web Vitals, Largest Contentful Paint (LCP), and Cumulative Layout Shift (CLS) scores remain perfectly optimized. Dynamic styling data is safely injected inline alongside existing stylesheets to avoid multiplying HTTP network handshakes.

= Security Engineering = \
Security forms the structural core of this application. Every internal execution loop utilizes strict WordPress validation wrappers, sanitization callbacks, and conditional permission checks. User metadata modifications undergo cryptographic nonce evaluation, and raw text entries are cleansed with strict sanitization engines. Frontend outputs are fully protected against Cross-Site Scripting (XSS) vectors using explicit contextual escaping functions.

= Translation Readiness = \
The entire application logic is strictly compiled using native WordPress globalization parameters. This makes the code architecture fully internationalized and ready to receive localized translation files (.mo and .po) across global networking environments.

= Features =
* Fully isolated "Disabled by Default" configuration logic ensures no layout shifting without admin permission.
* Deep User Profile metadata expansion incorporating structural layout fields for active social ecosystems.
* Support for major tracking networks: X (formerly Twitter), GitHub, LinkedIn, Facebook, and Instagram.
* Responsive multi-breakpoint layouts with native support for Vertical and Horizontal grid alignment configurations.
* Granular design customization parameters including border radii, internal padding, avatar boundaries, and HEX color palettes.
* Comprehensive shortcode management utilities supporting standalone global extraction or direct specific user targets.
* High-performance native Gutenberg Block offering visual workspace controls and modular block options.
* Strict compliance with official WordPress Coding Standards (WPCS).

= Shortcodes = \
The implementation features an enterprise shortcode engine that operates completely independently of global automatic insertion states.

`[author_box]`
Renders the author card for the author of the current post or page inside the active loop context.

`[author_box user_id="123"]`
Forces the engine to retrieve and render the specific profile asset map corresponding to User ID 123, completely independent of the active document's authorship status.

Shortcode Parameters:
* `user_id` (optional): Accepts a valid system integer corresponding to a specific user. If left unpopulated or missing, the plugin defaults to checking the current post loop author identifier or falls back to the current active session state.

= Gutenberg Block = \
The plugin bundles an integrated "Author Box" Gutenberg block directly within the block directory. This allows content managers to visually construct layout columns within the block editor.
* Search for "Author Box" inside the blocks panel to add it anywhere in your layout.
* Block Sidebar Panel: Control configuration metrics manually. Leave fields empty to query the contextual post author automatically, or key in a custom Target User ID directly within the Inspector fields to hardcode specific biographies.

= User Profile Fields = \
The plugin automatically extends the standard WordPress user profile management dashboard with a dedicated "Custom Networks Networking Matrix" interface. This maps the following secure URL input parameters:
* X (Twitter) URL Profile
* GitHub Developer Link
* LinkedIn Directory Profile
* Facebook Platform Profile Link
* Instagram Profile URL Link
* Custom Branding Website Hub

= Display Options = \
Manage layout behavioral options globally by navigating to the custom "Author Box Builder" menu.
* Global Visibility Switch: Keeps all automated programmatic insertion features off until manually enabled.
* Target Content Placements: Conditionally injects the author card layout beneath traditional Posts, standard Pages, or any active Custom Post Type (CPT) registered within your system.
* Canvas Options: Control design scales including Horizontal row layouts, Stacked Vertical alignments, precise internal padding settings, custom avatar borders, and specialized foreground/background HEX color picking options.

== Installation ==

= Manual Dashboard Upload =
1. Download the plugin archive file as a compressed ZIP package.
2. Navigate to your target WordPress Admin interface, then select Plugins > Add New > Upload Plugin.
3. Choose the ZIP file from your local machine and click Install Now.
4. Activate the plugin through the primary Plugins activation dashboard screen.

= FTP/SFTP Direct Deployment = 
1. Extract the local plugin ZIP archive folder named `author-box-builder`.
2. Connect to your live remote web server storage node using an secure FTP application.
3. Transfer the extracted directory into the server file stream location: `/wp-content/plugins/`.
4. Access the administration space, enter the Plugins menu panel, and choose Activate under the Author Box Builder entry label.

== Frequently Asked Questions ==

= Does enabling this plugin slow down page rendering parameters or alter PageSpeed metrics? = \
No. The plugin is built on an ultra-lightweight framework that eliminates heavy JavaScript frameworks, skips tracking code routines, and bypasses jQuery dependencies. It uses conditional loading logic to ensure that assets are only called when an author box is actively rendered on the page.

= Does the shortcode deployment still function properly if the Global Display setting is disabled? = \
Yes. The shortcode `[author_box]` and the native Gutenberg block run completely independent of the global display automation rules. Turning off the automated display switch allows you to place your author cards manually exactly where you want them.

= What happens if a user profile hasn't configured any social media link entries? = \
The layout utilizes an automated checking system that strips away empty fields. If an author hasn't added links for certain networks, those icons and placeholders are automatically removed from the frontend output to keep the design clean.

= Can I display an author card for a specific profile instead of the post author? = \
Yes. You can target specific user accounts by adding the `user_id` parameter to the shortcode, like `[author_box user_id="42"]`. You can also enter specific account numbers directly into the block settings panel within the Gutenberg editor interface.

= Does this plugin support custom post types created by other plugins? = \
Yes. The settings panel queries the system for all publicly available post structures. Any custom post types (such as portfolios, events, or products) will automatically show up as toggle options in the display configurations area.

= How do I modify the avatar image that appears inside the profile box? = \
The plugin works natively with the default WordPress Gravatar system. To update an author's image, simply update the profile email address associated with a valid Gravatar account, or use a local avatar upload plugin.

= Can I override the default frontend presentation styling using my theme's CSS stylesheets? = \
Yes. Every HTML container element is assigned a unique, semantic class prefix (`.abb-box-container`, `.abb-author-name`, `.abb-social-matrix`). You can easily add custom styling rules to your theme's style sheets or paste them directly into the Customizer.

= Does the plugin collect, track, or share any personal visitor information? = \
No. The plugin runs entirely locally within your site's database environment. It does not track cookies, gather analytics, contact external APIs, or transmit data to outside cloud servers, making it fully compliant with privacy laws like GDPR.

= Can I configure the social profile links to open inside a fresh browser tab? = \
Yes. All social media icon links are pre-configured with `target="_blank"` and `rel="noopener noreferrer"` attributes to keep visitors from losing their place on your primary website.

= Is there a built-in character limit applied to the biographical descriptions? = \
No. The system uses the default biographical text length stored in the WordPress user profile area. If an author writes a long description, the flexible box layout automatically scales vertically to prevent layout breaking or text overlap.

== Changelog ==

= 1.0.0 =
* Launch of production version framework build.
* Implementation of independent, secure Shortcode engine mapping.
* Deployment of dynamic Gutenberg blocks with custom Inspector settings.
* Addition of customizable profile tracking fields for X, GitHub, LinkedIn, Facebook, and Instagram.
* Introduction of design management options for custom padding, avatar radii, and HEX color fields.
* Fully internationalized setup using strict, secure WordPress escaping workflows.

== Upgrade Notice ==

= 1.0.0 = \
Initial public launch. Upgrade or install directly to begin building highly customizable author boxes immediately.

== Privacy ==

Author Box Builder does not engage in collecting, profiling, harvesting, or processing external data matrices. It does not track remote visitor sessions, utilize storage tracking cookies, or transmit user information to external third-party servers. All profile settings are stored safely inside your site's local database, ensuring complete compliance with global privacy regulations (GDPR and CCPA).