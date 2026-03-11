# SchoolDigger Widgets for WordPress

Embed interactive [SchoolDigger](https://www.schooldigger.com) school data widgets on your WordPress site — info cards, rankings, search, maps, and charts.

[![WordPress Plugin Version](https://img.shields.io/wordpress/plugin/v/schooldigger-widgets)](https://wordpress.org/plugins/schooldigger-widgets/)
[![License: GPL v2](https://img.shields.io/badge/License-GPLv2-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

## Available Widgets

| Widget | Plan | Description |
|--------|------|-------------|
| School Information Card | Free | School name, address, contact, grade levels, ranking |
| District Information Card | Free | District summary with school counts and rankings |
| Ranking Badge | Basic+ | Visual star rating and percentile indicator |
| School Finder | Basic+ | Search schools by ZIP, city, or address with filters |
| Top Schools List | Basic+ | Ranked list of top schools by state and level |
| School Autocomplete | Basic+ | Type-ahead search for schools |
| District Autocomplete | Basic+ | Type-ahead search for districts |
| Test Score Chart | Pro+ | Interactive bar/line charts for test score data |
| Nearby Schools Map | Pro+ | Interactive map with school markers and popups |

## Installation

1. Download from [WordPress.org](https://wordpress.org/plugins/schooldigger-widgets/) or upload the `schooldigger-widgets` folder to `/wp-content/plugins/`
2. Activate the plugin in **Plugins**
3. Go to **Settings > SchoolDigger Widgets** and enter your App ID
4. Add your WordPress domain in your [SchoolDigger dashboard](https://widgets.schooldigger.com/dashboard/domains)

Need an App ID? [Sign up free](https://widgets.schooldigger.com/signup).

## Usage

### Gutenberg Block

Add the **SchoolDigger Widget** block in the block editor. Select a widget type and configure options visually.

### Shortcode

```
[sd_widgets widget="school-info-card" school-id="340576000472"]
```

See the [WordPress integration guide](https://widgets.schooldigger.com/wordpress) for the full shortcode reference and an interactive configurator.

## Building from Source

The Gutenberg block JS is pre-built in `blocks/schooldigger-widget/build/`. To rebuild:

```bash
cd blocks/schooldigger-widget
npm install
npx wp-scripts build
```

## Links

- [WordPress.org Plugin Page](https://wordpress.org/plugins/schooldigger-widgets/)
- [WordPress Integration Guide](https://widgets.schooldigger.com/wordpress)
- [Widget Documentation](https://widgets.schooldigger.com/docs)
- [Demo](https://widgets.schooldigger.com/demo)
- [Pricing](https://widgets.schooldigger.com/pricing)
- [SchoolDigger](https://www.schooldigger.com)

## License

GPLv2 or later. See [LICENSE](LICENSE) for details.
