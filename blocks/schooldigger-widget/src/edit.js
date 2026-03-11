import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    SelectControl,
    TextControl,
    ToggleControl,
    Placeholder,
    Dashicon,
} from '@wordpress/components';

/**
 * Editor data injected by PHP (class-sd-widgets-block.php).
 * Contains: catalog, states, appId, baseUrl, settingsUrl
 */
const editorData = window.sdWidgetsEditor || {};
const catalog = editorData.catalog || {};
const statesList = editorData.states || {};
const appId = editorData.appId || '';
const baseUrl = editorData.baseUrl || 'https://widgets.schooldigger.com';
const wpGuideUrl = baseUrl + '/wordpress';
const settingsUrl = editorData.settingsUrl || '';

/**
 * Build state options for SelectControl.
 */
function getStateOptions() {
    const options = [ { value: '', label: __( '-- Select State --', 'schooldigger-widgets' ) } ];
    Object.keys( statesList ).forEach( ( code ) => {
        options.push( { value: code, label: `${ code } - ${ statesList[ code ] }` } );
    } );
    return options;
}

/**
 * Build widget type options for the main selector.
 */
function getWidgetTypeOptions() {
    const options = [ { value: '', label: __( '-- Select Widget Type --', 'schooldigger-widgets' ) } ];
    Object.keys( catalog ).forEach( ( widgetId ) => {
        const w = catalog[ widgetId ];
        options.push( {
            value: widgetId,
            label: `${ w.name } (${ w.minimumTier }+)`,
        } );
    } );
    return options;
}

/**
 * Render a parameter control based on its type.
 */
function ParameterControl( { param, value, onChange } ) {
    const paramValue = value !== undefined ? String( value ) : ( param.default || '' );

    switch ( param.type ) {
        case 'boolean':
            return (
                <ToggleControl
                    label={ param.displayName }
                    help={ param.description || '' }
                    checked={ paramValue === 'true' }
                    onChange={ ( val ) => onChange( val ? 'true' : 'false' ) }
                />
            );

        case 'enum':
            return (
                <SelectControl
                    label={ param.displayName }
                    help={ param.description || '' }
                    value={ paramValue }
                    options={ ( param.options || [] ).map( ( opt ) => ( {
                        value: opt.value,
                        label: opt.label,
                    } ) ) }
                    onChange={ onChange }
                />
            );

        case 'stateSelect':
            return (
                <SelectControl
                    label={ param.displayName }
                    help={ param.description || '' }
                    value={ paramValue }
                    options={ getStateOptions() }
                    onChange={ onChange }
                />
            );

        case 'schoolPicker':
        case 'districtPicker':
        case 'text':
        default:
            return (
                <TextControl
                    label={ param.displayName }
                    help={ param.description || ( param.type === 'schoolPicker'
                        ? __( 'Enter the SchoolDigger school ID. Look up IDs at', 'schooldigger-widgets' ) + ' ' + wpGuideUrl
                        : param.type === 'districtPicker'
                            ? __( 'Enter the SchoolDigger district ID. Look up IDs at', 'schooldigger-widgets' ) + ' ' + wpGuideUrl
                            : '' ) }
                    value={ paramValue }
                    onChange={ onChange }
                    placeholder={ param.type === 'schoolPicker'
                        ? 'e.g., 340576000472'
                        : param.type === 'districtPicker'
                            ? 'e.g., 0600001'
                            : '' }
                />
            );
    }
}

/**
 * Block Editor component.
 */
export default function Edit( { attributes, setAttributes } ) {
    const blockProps = useBlockProps();
    const { widgetType, params, config } = attributes;
    const widgetDef = widgetType ? catalog[ widgetType ] : null;

    // No App ID configured -- show error.
    if ( ! appId ) {
        return (
            <div { ...blockProps }>
                <div className="sd-widget-block-placeholder sd-widget-block-no-appid">
                    <Dashicon icon="warning" />
                    <p>
                        { __( 'SchoolDigger Widgets: No App ID configured.', 'schooldigger-widgets' ) }
                        { ' ' }
                        <a href={ settingsUrl }>
                            { __( 'Configure in Settings', 'schooldigger-widgets' ) }
                        </a>
                    </p>
                </div>
            </div>
        );
    }

    /**
     * Update a single parameter value.
     */
    function setParam( paramName, value ) {
        setAttributes( {
            params: {
                ...params,
                [ paramName ]: value,
            },
        } );
    }

    /**
     * Handle widget type change -- reset params.
     */
    function onWidgetTypeChange( newType ) {
        setAttributes( {
            widgetType: newType,
            params: {},
        } );
    }

    /**
     * Build a human-readable summary of configured params.
     */
    function getParamsSummary() {
        if ( ! widgetDef || ! params ) return '';
        const parts = [];
        ( widgetDef.parameters || [] ).forEach( ( p ) => {
            const val = params[ p.name ];
            if ( val !== undefined && val !== '' && val !== p.default ) {
                parts.push( `${ p.displayName }: ${ val }` );
            }
        } );
        // Also show required params with their values.
        ( widgetDef.parameters || [] ).forEach( ( p ) => {
            if ( p.required && params[ p.name ] && ! parts.some( ( s ) => s.startsWith( p.displayName ) ) ) {
                parts.push( `${ p.displayName }: ${ params[ p.name ] }` );
            }
        } );
        return parts.join( ' | ' );
    }

    return (
        <div { ...blockProps }>
            <InspectorControls>
                <PanelBody title={ __( 'Widget Type', 'schooldigger-widgets' ) } initialOpen={ true }>
                    <SelectControl
                        label={ __( 'Widget', 'schooldigger-widgets' ) }
                        value={ widgetType }
                        options={ getWidgetTypeOptions() }
                        onChange={ onWidgetTypeChange }
                    />
                    { widgetDef && (
                        <p className="components-base-control__help">
                            { widgetDef.description }
                        </p>
                    ) }
                </PanelBody>

                { widgetDef && (
                    <PanelBody title={ __( 'Widget Settings', 'schooldigger-widgets' ) } initialOpen={ true }>
                        { ( widgetDef.parameters || [] ).map( ( param ) => (
                            <ParameterControl
                                key={ param.name }
                                param={ param }
                                value={ params[ param.name ] }
                                onChange={ ( val ) => setParam( param.name, val ) }
                            />
                        ) ) }
                    </PanelBody>
                ) }

                <PanelBody title={ __( 'Style Config', 'schooldigger-widgets' ) } initialOpen={ false }>
                    <TextControl
                        label={ __( 'Config Override', 'schooldigger-widgets' ) }
                        help={ __( 'Base64-encoded style config. Generate one at', 'schooldigger-widgets' ) + ' ' + wpGuideUrl }
                        value={ config }
                        onChange={ ( val ) => setAttributes( { config: val } ) }
                    />
                </PanelBody>
            </InspectorControls>

            { /* Block content area -- placeholder preview */ }
            { ! widgetType ? (
                <Placeholder
                    icon="welcome-learn-more"
                    label={ __( 'SchoolDigger Widget', 'schooldigger-widgets' ) }
                    instructions={ __( 'Select a widget type from the block settings panel on the right. Need help? Visit the WordPress Guide at', 'schooldigger-widgets' ) + ' ' + wpGuideUrl }
                >
                    <SelectControl
                        value={ widgetType }
                        options={ getWidgetTypeOptions() }
                        onChange={ onWidgetTypeChange }
                    />
                </Placeholder>
            ) : (
                <div className="sd-widget-block-placeholder has-widget">
                    <Dashicon icon={ widgetDef?.icon || 'welcome-learn-more' } />
                    <h4>{ widgetDef?.name || widgetType }</h4>
                    <span className={ `sd-widget-tier-badge tier-${ ( widgetDef?.minimumTier || '' ).toLowerCase() }` }>
                        { widgetDef?.minimumTier }+
                    </span>
                    { getParamsSummary() && (
                        <div className="sd-widget-params-summary">
                            { getParamsSummary() }
                        </div>
                    ) }
                </div>
            ) }
        </div>
    );
}
