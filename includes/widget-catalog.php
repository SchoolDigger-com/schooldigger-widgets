<?php
/**
 * Widget catalog definitions.
 *
 * Derived from widget-catalog.json in the main widgets app.
 * Each widget defines its type slug, display name, tier, and parameters.
 * Parameters include type info used by the Gutenberg block editor UI.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get the full widget catalog.
 *
 * @return array Associative array keyed by widget ID.
 */
function sd_widgets_get_catalog() {
    static $catalog = null;
    if ( null !== $catalog ) {
        return $catalog;
    }

    $catalog = array(
        'school-info-card' => array(
            'name'        => 'School Information Card',
            'description' => 'Display basic school information in a compact card format.',
            'category'    => 'School Profile',
            'minimumTier' => 'Free',
            'icon'        => 'building',
            'parameters'  => array(
                array( 'name' => 'schoolId',    'dataAttr' => 'school-id',    'displayName' => 'School ID',       'type' => 'schoolPicker', 'required' => true ),
                array( 'name' => 'showAddress', 'dataAttr' => 'show-address', 'displayName' => 'Show Address',    'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showPhone',   'dataAttr' => 'show-phone',   'displayName' => 'Show Phone',      'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showGrades',  'dataAttr' => 'show-grades',  'displayName' => 'Show Grade Levels','type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showRanking', 'dataAttr' => 'show-ranking', 'displayName' => 'Show Ranking',    'type' => 'boolean', 'default' => 'true', 'minimumTier' => 'Basic' ),
            ),
        ),
        'district-info-card' => array(
            'name'        => 'District Information Card',
            'description' => 'Display basic district information in a compact card format.',
            'category'    => 'District Profile',
            'minimumTier' => 'Free',
            'icon'        => 'admin-multisite',
            'parameters'  => array(
                array( 'name' => 'districtId',     'dataAttr' => 'district-id',      'displayName' => 'District ID',       'type' => 'districtPicker', 'required' => true ),
                array( 'name' => 'showAddress',    'dataAttr' => 'show-address',     'displayName' => 'Show Address',      'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showPhone',      'dataAttr' => 'show-phone',       'displayName' => 'Show Phone',        'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showGrades',     'dataAttr' => 'show-grades',      'displayName' => 'Show Grade Levels', 'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showSchoolCounts','dataAttr' => 'show-school-counts','displayName' => 'Show School Counts','type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showRanking',    'dataAttr' => 'show-ranking',     'displayName' => 'Show Ranking',      'type' => 'boolean', 'default' => 'true', 'minimumTier' => 'Basic' ),
            ),
        ),
        'ranking-badge' => array(
            'name'        => 'Ranking Badge',
            'description' => 'Show school ranking with a visual badge, ribbon, or minimal indicator.',
            'category'    => 'Rankings',
            'minimumTier' => 'Basic',
            'icon'        => 'awards',
            'parameters'  => array(
                array( 'name' => 'schoolId',         'dataAttr' => 'school-id',         'displayName' => 'School ID',          'type' => 'schoolPicker', 'required' => true ),
                array( 'name' => 'style',            'dataAttr' => 'style',             'displayName' => 'Badge Style',        'type' => 'enum', 'default' => 'badge', 'options' => array(
                    array( 'value' => 'badge',   'label' => 'Badge' ),
                    array( 'value' => 'ribbon',  'label' => 'Ribbon' ),
                    array( 'value' => 'minimal', 'label' => 'Minimal' ),
                )),
                array( 'name' => 'showStateContext', 'dataAttr' => 'show-state-context','displayName' => 'Show State Context', 'type' => 'boolean', 'default' => 'true' ),
            ),
        ),
        'school-finder' => array(
            'name'        => 'School Finder',
            'description' => 'Interactive search widget to find schools by ZIP code, city, or full address.',
            'category'    => 'Search',
            'minimumTier' => 'Basic',
            'icon'        => 'search',
            'parameters'  => array(
                array( 'name' => 'searchMode',      'dataAttr' => 'search-mode',      'displayName' => 'Search Mode',        'type' => 'enum', 'default' => 'simple', 'options' => array(
                    array( 'value' => 'simple',  'label' => 'ZIP Code or City' ),
                    array( 'value' => 'address', 'label' => 'Full Address (radius)' ),
                )),
                array( 'name' => 'initialState',    'dataAttr' => 'initial-state',    'displayName' => 'Default State',      'type' => 'stateSelect' ),
                array( 'name' => 'initialZip',      'dataAttr' => 'initial-zip',      'displayName' => 'Initial ZIP Code',   'type' => 'text' ),
                array( 'name' => 'initialCity',     'dataAttr' => 'initial-city',     'displayName' => 'Initial City',       'type' => 'text' ),
                array( 'name' => 'initialStreet',   'dataAttr' => 'initial-street',   'displayName' => 'Initial Street',     'type' => 'text', 'description' => 'For address mode' ),
                array( 'name' => 'defaultRadius',   'dataAttr' => 'default-radius',   'displayName' => 'Default Radius',     'type' => 'enum', 'default' => '10', 'options' => array(
                    array( 'value' => '5',  'label' => '5 miles' ),
                    array( 'value' => '10', 'label' => '10 miles' ),
                    array( 'value' => '15', 'label' => '15 miles' ),
                    array( 'value' => '25', 'label' => '25 miles' ),
                    array( 'value' => '50', 'label' => '50 miles' ),
                )),
                array( 'name' => 'defaultLevel',    'dataAttr' => 'default-level',    'displayName' => 'Default Level',      'type' => 'enum', 'default' => '', 'options' => array(
                    array( 'value' => '',           'label' => 'All Levels' ),
                    array( 'value' => 'Elementary', 'label' => 'Elementary' ),
                    array( 'value' => 'Middle',     'label' => 'Middle' ),
                    array( 'value' => 'High',       'label' => 'High' ),
                    array( 'value' => 'Alt',        'label' => 'Alternative' ),
                    array( 'value' => 'Public',     'label' => 'Public' ),
                    array( 'value' => 'Private',    'label' => 'Private' ),
                )),
                array( 'name' => 'maxResults',      'dataAttr' => 'max-results',      'displayName' => 'Max Results',        'type' => 'enum', 'default' => '100', 'options' => array(
                    array( 'value' => '5',   'label' => '5 schools' ),
                    array( 'value' => '10',  'label' => '10 schools' ),
                    array( 'value' => '15',  'label' => '15 schools' ),
                    array( 'value' => '20',  'label' => '20 schools' ),
                    array( 'value' => '50',  'label' => '50 schools' ),
                    array( 'value' => '100', 'label' => '100 schools' ),
                )),
                array( 'name' => 'maxHeight',       'dataAttr' => 'max-height',       'displayName' => 'Max Height (px)',    'type' => 'text', 'default' => '500' ),
                array( 'name' => 'allowAutoExpand',  'dataAttr' => 'allow-auto-expand','displayName' => 'Allow Auto-Expand',  'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showRankings',    'dataAttr' => 'show-rankings',    'displayName' => 'Show Rankings',      'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showLevelFilter', 'dataAttr' => 'show-level-filter','displayName' => 'Show Level Filter',  'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showRadiusFilter','dataAttr' => 'show-radius-filter','displayName' => 'Show Radius Filter','type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'onSchoolClick',   'dataAttr' => 'on-school-click',  'displayName' => 'School Click Action','type' => 'enum', 'default' => 'navigate', 'options' => array(
                    array( 'value' => 'navigate', 'label' => 'Open SchoolDigger page' ),
                    array( 'value' => 'callback', 'label' => 'JavaScript callback' ),
                )),
            ),
        ),
        'test-score-chart' => array(
            'name'        => 'Test Score Chart',
            'description' => 'Visualize test score performance with configurable chart type and axes.',
            'category'    => 'Test Scores',
            'minimumTier' => 'Pro',
            'icon'        => 'chart-bar',
            'parameters'  => array(
                array( 'name' => 'schoolId',            'dataAttr' => 'school-id',            'displayName' => 'School ID',              'type' => 'schoolPicker', 'required' => true ),
                array( 'name' => 'chartType',           'dataAttr' => 'chart-type',           'displayName' => 'Chart Type',             'type' => 'enum', 'default' => 'bar', 'options' => array(
                    array( 'value' => 'bar',  'label' => 'Bar Chart' ),
                    array( 'value' => 'line', 'label' => 'Line Chart' ),
                )),
                array( 'name' => 'xAxis',              'dataAttr' => 'x-axis',               'displayName' => 'X-Axis Data',            'type' => 'enum', 'default' => 'subject', 'options' => array(
                    array( 'value' => 'subject', 'label' => 'Subject/Test' ),
                    array( 'value' => 'year',    'label' => 'Year' ),
                    array( 'value' => 'grade',   'label' => 'Grade' ),
                )),
                array( 'name' => 'year',                'dataAttr' => 'year',                 'displayName' => 'Default Year',           'type' => 'text' ),
                array( 'name' => 'grade',               'dataAttr' => 'grade',                'displayName' => 'Default Grade',          'type' => 'text' ),
                array( 'name' => 'subject',             'dataAttr' => 'subject',              'displayName' => 'Default Subject',        'type' => 'text' ),
                array( 'name' => 'showFilters',         'dataAttr' => 'show-filters',         'displayName' => 'Show Filters',           'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showDistrictAverage', 'dataAttr' => 'show-district-average','displayName' => 'Show District Scores',   'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showStateAverage',    'dataAttr' => 'show-state-average',   'displayName' => 'Show State Scores',      'type' => 'boolean', 'default' => 'true' ),
            ),
        ),
        'school-autocomplete' => array(
            'name'        => 'School Autocomplete',
            'description' => 'Type-ahead search for finding and selecting schools.',
            'category'    => 'Search',
            'minimumTier' => 'Basic',
            'icon'        => 'editor-ul',
            'parameters'  => array(
                array( 'name' => 'placeholder',         'dataAttr' => 'placeholder',           'displayName' => 'Placeholder Text',       'type' => 'text', 'default' => 'Search for a school...' ),
                array( 'name' => 'defaultLevel',        'dataAttr' => 'default-level',         'displayName' => 'School Level Filter',    'type' => 'enum', 'default' => '', 'options' => array(
                    array( 'value' => '',           'label' => 'All Levels' ),
                    array( 'value' => 'Elementary', 'label' => 'Elementary' ),
                    array( 'value' => 'Middle',     'label' => 'Middle' ),
                    array( 'value' => 'High',       'label' => 'High' ),
                    array( 'value' => 'Alt',        'label' => 'Alternative' ),
                    array( 'value' => 'Private',    'label' => 'Private' ),
                )),
                array( 'name' => 'defaultState',        'dataAttr' => 'default-state',         'displayName' => 'Default State',          'type' => 'stateSelect' ),
                array( 'name' => 'districtId',          'dataAttr' => 'district-id',           'displayName' => 'Limit to District',      'type' => 'districtPicker' ),
                array( 'name' => 'searchCityStateName', 'dataAttr' => 'search-city-state-name','displayName' => 'Search by City Name',    'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'maxResults',          'dataAttr' => 'max-results',           'displayName' => 'Max Results',            'type' => 'enum', 'default' => '10', 'options' => array(
                    array( 'value' => '5',  'label' => '5 results' ),
                    array( 'value' => '10', 'label' => '10 results' ),
                    array( 'value' => '15', 'label' => '15 results' ),
                    array( 'value' => '20', 'label' => '20 results' ),
                )),
                array( 'name' => 'showGrades',          'dataAttr' => 'show-grades',           'displayName' => 'Show Grade Levels',      'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showLocation',        'dataAttr' => 'show-location',         'displayName' => 'Show City/State',        'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'onSelectAction',      'dataAttr' => 'on-select-action',      'displayName' => 'On Select Action',       'type' => 'enum', 'default' => 'callback', 'options' => array(
                    array( 'value' => 'callback', 'label' => 'JavaScript Callback' ),
                    array( 'value' => 'navigate', 'label' => 'Navigate to SchoolDigger' ),
                )),
            ),
        ),
        'district-autocomplete' => array(
            'name'        => 'District Autocomplete',
            'description' => 'Type-ahead search for finding and selecting school districts.',
            'category'    => 'Search',
            'minimumTier' => 'Basic',
            'icon'        => 'editor-ul',
            'parameters'  => array(
                array( 'name' => 'placeholder',    'dataAttr' => 'placeholder',      'displayName' => 'Placeholder Text',  'type' => 'text', 'default' => 'Search for a district...' ),
                array( 'name' => 'defaultState',   'dataAttr' => 'default-state',    'displayName' => 'Default State',     'type' => 'stateSelect' ),
                array( 'name' => 'maxResults',     'dataAttr' => 'max-results',      'displayName' => 'Max Results',       'type' => 'enum', 'default' => '10', 'options' => array(
                    array( 'value' => '5',  'label' => '5 results' ),
                    array( 'value' => '10', 'label' => '10 results' ),
                    array( 'value' => '15', 'label' => '15 results' ),
                    array( 'value' => '20', 'label' => '20 results' ),
                )),
                array( 'name' => 'showGrades',     'dataAttr' => 'show-grades',      'displayName' => 'Show Grade Levels', 'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showLocation',   'dataAttr' => 'show-location',    'displayName' => 'Show City/State',   'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'onSelectAction', 'dataAttr' => 'on-select-action', 'displayName' => 'On Select Action',  'type' => 'enum', 'default' => 'callback', 'options' => array(
                    array( 'value' => 'callback', 'label' => 'JavaScript Callback' ),
                    array( 'value' => 'navigate', 'label' => 'Navigate to SchoolDigger' ),
                )),
            ),
        ),
        'top-schools-list' => array(
            'name'        => 'Top Schools List',
            'description' => 'Display a ranked list of top schools in a state.',
            'category'    => 'Rankings',
            'minimumTier' => 'Basic',
            'icon'        => 'list-view',
            'parameters'  => array(
                array( 'name' => 'state',          'dataAttr' => 'state',           'displayName' => 'State',              'type' => 'stateSelect', 'required' => true ),
                array( 'name' => 'level',          'dataAttr' => 'level',           'displayName' => 'School Level',       'type' => 'enum', 'required' => true, 'default' => 'Elementary', 'options' => array(
                    array( 'value' => 'Elementary', 'label' => 'Elementary' ),
                    array( 'value' => 'Middle',     'label' => 'Middle' ),
                    array( 'value' => 'High',       'label' => 'High' ),
                )),
                array( 'name' => 'count',          'dataAttr' => 'count',           'displayName' => 'Number of Schools',  'type' => 'enum', 'default' => '10', 'options' => array(
                    array( 'value' => '5',  'label' => 'Top 5' ),
                    array( 'value' => '10', 'label' => 'Top 10' ),
                    array( 'value' => '15', 'label' => 'Top 15' ),
                    array( 'value' => '20', 'label' => 'Top 20' ),
                    array( 'value' => '25', 'label' => 'Top 25' ),
                )),
                array( 'name' => 'showStars',      'dataAttr' => 'show-stars',      'displayName' => 'Show Star Ratings',  'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showLocation',   'dataAttr' => 'show-location',   'displayName' => 'Show City/State',    'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showPercentage', 'dataAttr' => 'show-percentage', 'displayName' => 'Show Rank Percentage','type' => 'boolean', 'default' => 'false' ),
                array( 'name' => 'maxHeight',      'dataAttr' => 'max-height',      'displayName' => 'Max Height (px)',    'type' => 'text', 'default' => '400' ),
                array( 'name' => 'onSchoolClick',  'dataAttr' => 'on-school-click', 'displayName' => 'School Click Action','type' => 'enum', 'default' => 'navigate', 'options' => array(
                    array( 'value' => 'navigate', 'label' => 'Open SchoolDigger page' ),
                    array( 'value' => 'callback', 'label' => 'JavaScript callback' ),
                )),
            ),
        ),
        'nearby-schools-map' => array(
            'name'        => 'Nearby Schools Map',
            'description' => 'Interactive map displaying schools near a location. Uses OpenStreetMap or Mapbox.',
            'category'    => 'Maps',
            'minimumTier' => 'Pro',
            'icon'        => 'location-alt',
            'parameters'  => array(
                array( 'name' => 'centerMode',           'dataAttr' => 'center-mode',            'displayName' => 'Center Map On',           'type' => 'enum', 'required' => true, 'default' => 'school', 'options' => array(
                    array( 'value' => 'school',  'label' => 'Specific School' ),
                    array( 'value' => 'address', 'label' => 'Full Address' ),
                    array( 'value' => 'latlong', 'label' => 'Latitude/Longitude' ),
                )),
                array( 'name' => 'schoolId',             'dataAttr' => 'school-id',              'displayName' => 'Center School ID',        'type' => 'schoolPicker', 'description' => 'For "Specific School" mode' ),
                array( 'name' => 'centerAddress',        'dataAttr' => 'center-address',         'displayName' => 'Center Address',          'type' => 'text', 'description' => 'For "Address" mode' ),
                array( 'name' => 'centerLatitude',       'dataAttr' => 'center-latitude',        'displayName' => 'Latitude',                'type' => 'text', 'description' => 'For "Lat/Long" mode' ),
                array( 'name' => 'centerLongitude',      'dataAttr' => 'center-longitude',       'displayName' => 'Longitude',               'type' => 'text', 'description' => 'For "Lat/Long" mode' ),
                array( 'name' => 'centerState',          'dataAttr' => 'center-state',           'displayName' => 'State',                   'type' => 'stateSelect' ),
                array( 'name' => 'radiusMiles',          'dataAttr' => 'radius-miles',           'displayName' => 'Search Radius',           'type' => 'enum', 'default' => '5', 'options' => array(
                    array( 'value' => '1',  'label' => '1 mile' ),
                    array( 'value' => '2',  'label' => '2 miles' ),
                    array( 'value' => '5',  'label' => '5 miles' ),
                    array( 'value' => '10', 'label' => '10 miles' ),
                    array( 'value' => '15', 'label' => '15 miles' ),
                    array( 'value' => '25', 'label' => '25 miles' ),
                )),
                array( 'name' => 'level',                'dataAttr' => 'level',                  'displayName' => 'School Level Filter',     'type' => 'enum', 'default' => '', 'options' => array(
                    array( 'value' => '',           'label' => 'All Levels' ),
                    array( 'value' => 'Elementary', 'label' => 'Elementary' ),
                    array( 'value' => 'Middle',     'label' => 'Middle' ),
                    array( 'value' => 'High',       'label' => 'High' ),
                    array( 'value' => 'Private',    'label' => 'Private' ),
                )),
                array( 'name' => 'maxResults',           'dataAttr' => 'max-results',            'displayName' => 'Max Schools',             'type' => 'enum', 'default' => '50', 'options' => array(
                    array( 'value' => '10',  'label' => '10 schools' ),
                    array( 'value' => '25',  'label' => '25 schools' ),
                    array( 'value' => '50',  'label' => '50 schools' ),
                    array( 'value' => '100', 'label' => '100 schools' ),
                )),
                array( 'name' => 'mapProvider',          'dataAttr' => 'map-provider',           'displayName' => 'Map Provider',            'type' => 'enum', 'default' => 'openstreetmap', 'options' => array(
                    array( 'value' => 'openstreetmap', 'label' => 'OpenStreetMap (free)' ),
                    array( 'value' => 'mapbox',        'label' => 'Mapbox (requires key)' ),
                )),
                array( 'name' => 'mapApiKey',            'dataAttr' => 'map-api-key',            'displayName' => 'Mapbox API Key',          'type' => 'text', 'description' => 'Required if using Mapbox' ),
                array( 'name' => 'zoomLevel',            'dataAttr' => 'zoom-level',             'displayName' => 'Initial Zoom',            'type' => 'enum', 'default' => '12', 'options' => array(
                    array( 'value' => '10', 'label' => '10 - City level' ),
                    array( 'value' => '11', 'label' => '11' ),
                    array( 'value' => '12', 'label' => '12 - Neighborhood' ),
                    array( 'value' => '13', 'label' => '13' ),
                    array( 'value' => '14', 'label' => '14 - Streets' ),
                    array( 'value' => '15', 'label' => '15 - Close up' ),
                )),
                array( 'name' => 'showZoomControls',     'dataAttr' => 'show-zoom-controls',     'displayName' => 'Show Zoom Controls',      'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'isInteractive',        'dataAttr' => 'is-interactive',         'displayName' => 'Interactive Map',         'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'reloadOnMove',         'dataAttr' => 'reload-on-move',         'displayName' => 'Reload on Pan/Zoom',     'type' => 'boolean', 'default' => 'false' ),
                array( 'name' => 'highlightCenterSchool','dataAttr' => 'highlight-center-school','displayName' => 'Highlight Center School', 'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showStarsInPopup',     'dataAttr' => 'show-stars-in-popup',    'displayName' => 'Stars in Popup',          'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showAddressInPopup',   'dataAttr' => 'show-address-in-popup',  'displayName' => 'Address in Popup',        'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showGradesInPopup',    'dataAttr' => 'show-grades-in-popup',   'displayName' => 'Grades in Popup',         'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'showLevelInPopup',     'dataAttr' => 'show-level-in-popup',    'displayName' => 'Level in Popup',          'type' => 'boolean', 'default' => 'true' ),
                array( 'name' => 'onSchoolClick',        'dataAttr' => 'on-school-click',        'displayName' => 'School Click Action',     'type' => 'enum', 'default' => 'navigate', 'options' => array(
                    array( 'value' => 'navigate', 'label' => 'Open SchoolDigger page' ),
                    array( 'value' => 'callback', 'label' => 'JavaScript callback' ),
                )),
            ),
        ),
    );

    return $catalog;
}

/**
 * Get US states for select controls.
 *
 * @return array Associative array of state code => state name.
 */
function sd_widgets_get_states() {
    return array(
        'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas',
        'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware',
        'DC' => 'District of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii',
        'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa',
        'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine',
        'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota',
        'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska',
        'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico',
        'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio',
        'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island',
        'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas',
        'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington',
        'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming',
    );
}
