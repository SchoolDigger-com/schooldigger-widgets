=== SchoolDigger Widgets ===
Contributors: schooldigger
Tags: school, education, widgets, ranking, K-12
Requires at least: 6.0
Tested up to: 6.9
Stable tag: 1.0.5
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
GitHub: https://github.com/SchoolDigger-com/schooldigger-widgets

Embed interactive SchoolDigger school data widgets on your WordPress site - info cards, rankings, search, maps, and charts.

== Description ==

**SchoolDigger Widgets** lets you embed interactive, data-rich school and district widgets on any WordPress page or post. Powered by [SchoolDigger](https://www.schooldigger.com), the widgets display up-to-date school information, rankings, test scores, and more.

**Available Widgets:**

* **School Information Card** (Free) — School name, address, contact, grade levels, and ranking
* **District Information Card** (Free) — District summary with school counts and rankings
* **Ranking Badge** (Basic+) — Visual star rating and percentile indicator
* **School Finder** (Basic+) — Search schools by ZIP code, city, or address with filters
* **Top Schools List** (Basic+) — Ranked list of top schools by state and level
* **School Autocomplete** (Basic+) — Type-ahead search for schools
* **District Autocomplete** (Basic+) — Type-ahead search for districts
* **Test Score Chart** (Pro+) — Interactive bar/line charts for test score data
* **Nearby Schools Map** (Pro+) — Interactive map with school markers and popups

**Two ways to embed:**

1. **Gutenberg Block** — Visual widget configurator in the block editor
2. **Shortcode** — `[sd_widgets widget="school-info-card" school-id="340576000472"]`

**External Service:**

This plugin relies on the [SchoolDigger Widgets](https://widgets.schooldigger.com) service to load and render widgets. When a page containing a widget is viewed, a JavaScript file is loaded from `https://widgets.schooldigger.com` and widget data is fetched from the SchoolDigger API. No personal visitor data is collected or transmitted — only the widget parameters (school ID, widget type, etc.) are sent to retrieve public school data.

* Service URL: [https://widgets.schooldigger.com](https://widgets.schooldigger.com)
* Terms of Service: [https://widgets.schooldigger.com/terms](https://widgets.schooldigger.com/terms)
* Privacy Policy: [https://widgets.schooldigger.com/privacy](https://widgets.schooldigger.com/privacy)

== Installation ==

1. Upload the `schooldigger-widgets` folder to `/wp-content/plugins/`
2. Activate the plugin through the **Plugins** screen in WordPress
3. Go to **Settings > SchoolDigger Widgets**
4. Enter your App ID (create a free account at [widgets.schooldigger.com](https://widgets.schooldigger.com/signup) if you don't have one)
5. Add your WordPress domain to the domain whitelist in your [SchoolDigger dashboard](https://widgets.schooldigger.com/dashboard/domains)

== Frequently Asked Questions ==

= Where do I get an App ID? =

Sign up for a free account at [widgets.schooldigger.com](https://widgets.schooldigger.com/signup). Your App ID can be found on the [WordPress integration guide](https://widgets.schooldigger.com/wordpress).

= How do I find a School ID or District ID? =

Use the ID lookup tool on the [WordPress integration guide](https://widgets.schooldigger.com/wordpress). Search by school or district name and copy the ID directly.

= My widget shows an error or doesn't load =

Make sure your WordPress domain is added to your domain whitelist in the SchoolDigger dashboard (Settings > Domains). The domain must match exactly.

= Which widgets are available on the Free plan? =

The Free plan includes School Information Card and District Information Card. Upgrade to Basic for search and ranking widgets, or Pro for charts and maps. See [pricing](https://widgets.schooldigger.com/#pricing).

= Can I use multiple widgets on the same page? =

Yes. Each widget operates independently. The loader script is automatically included only once regardless of how many widgets are on the page.

== Shortcode Reference ==

**School Info Card:**
`[sd_widgets widget="school-info-card" school-id="340576000472" show-address="true" show-ranking="true"]`

**District Info Card:**
`[sd_widgets widget="district-info-card" district-id="0600001" show-school-counts="true"]`

**Ranking Badge:**
`[sd_widgets widget="ranking-badge" school-id="340576000472" style="badge"]`

**School Finder:**
`[sd_widgets widget="school-finder" search-mode="simple" initial-state="CA" default-level="Elementary"]`

**Top Schools List:**
`[sd_widgets widget="top-schools-list" state="NY" level="High" count="10"]`

**Nearby Schools Map:**
`[sd_widgets widget="nearby-schools-map" center-mode="school" school-id="340576000472" radius-miles="5"]`

**Test Score Chart:**
`[sd_widgets widget="test-score-chart" school-id="340576000472" chart-type="bar" x-axis="subject"]`

== Build Instructions ==

The Gutenberg block JavaScript in `blocks/schooldigger-widget/build/` is compiled from the human-readable source files included in `blocks/schooldigger-widget/src/`.

To rebuild from source:

1. Navigate to `blocks/schooldigger-widget/`
2. Run `npm install`
3. Run `npx wp-scripts build`

This uses [@wordpress/scripts](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/) (webpack-based) to compile `src/index.js` and `src/edit.js` into `build/index.js`.

== Changelog ==

= 1.0.5 =
* Renamed shortcode from [schooldigger] to [sd_widgets] for unique prefixing per WordPress.org guidelines
* Added Build Instructions section to readme with source code location and build steps for compiled JS

= 1.0.0 =
* Initial release
* Support for all 9 SchoolDigger widget types
* Gutenberg block with visual configuration
* Shortcode support with full parameter passthrough
* Settings page with App ID configuration and account management links

== Upgrade Notice ==

= 1.0.0 =
Initial release.
