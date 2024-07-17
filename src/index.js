
/**
 * Main index.js file.
 * 
 * @since 0.1.0
 */

/**
 * Define consts.
 */
//import classnames from 'classnames';

const { assign, merge } = lodash;

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, SelectControl } = wp.components;

/**
 * Add animation attributes.
 * 
 * Add the attributes we need.
 * 
 * @param {Object} settings Original block settings.
 * @param {string} name 	Block name.
 * @returns {Object}		Filtered block settings.
 */
function addAnimationAtts( settings, name ) {
	return assign( {}, settings, {
		attributes: merge( settings.attributes, {
			animation_slug: {
				type: 'string',
				default: ''
			}
		}),
	});
}
addFilter(
	'blocks.registerBlockType',
	'wonder-animations/add-animation-atts',
	addAnimationAtts
);

/**
 * Add the controls for the attributes.
 */
const addAnimationAttributeControls = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const {
			attributes: { animation_slug },
			setAttributes,
			name,
		} = props;

		const animations = wonderAnimations;
		const animOptions = [ { label: '', value: '' } ];
		
		for (let i = 0; i < animations.length; i++) {
			animOptions.push( { label: animations[i].label, value: animations[i].slug.replace( ' ', '-' ).toUpperCase() } );
		}

		return (
			<>
				<BlockEdit {...props} />
				<InspectorControls>
					<PanelBody
						title={__( 'Animation settings', 'wonder-animations' )}
						initialOpen={false}
					>
						<SelectControl
							label={__( 'Animation name', 'wonder-animations' )}
							value={ animation_slug }
							options={animOptions}
							onChange={ (value) => {
								setAttributes({ animation_slug: value });
							}}
						/>
					</PanelBody>
				</InspectorControls>
			</>
		)
	}
}, 'addAnimationAttributeControls' );

addFilter(
	'editor.BlockEdit',
	'wonder-animations/add-animation-attribute-controls',
	addAnimationAttributeControls
);