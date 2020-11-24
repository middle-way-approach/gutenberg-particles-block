const { InspectorControls } = wp.blockEditor;
const { PanelBody, RangeControl, ColorPicker } = wp.components;

function rgbToHex( colorString ) {
	const a = '#' + colorString.split( ',' ).map( x => {
		const hex = Number( x ).toString( 16 );
		return hex.length === 1 ? '0' + hex : hex;
	} ).join( '' );
	return a;
}

const Controls = ( { attributes, setAttributes } ) => {
	return <InspectorControls>
		<PanelBody title={ 'Particles' }>
			<RangeControl
				label="Count"
				value={ attributes.count }
				onChange={ ( count ) => setAttributes( { count } ) }
				min={ 10 }
				max={ 300 }
			/>
			<RangeControl
				label="Opacity"
				value={ attributes.opacity }
				onChange={ ( opacity ) => setAttributes( { opacity } ) }
				min={ 0.1 }
				max={ 1 }
				step={ 0.1 }
			/>
			<ColorPicker
				color={ rgbToHex( attributes.color ) }
				onChangeComplete={ ( color ) => setAttributes( { color: Object.values( color.rgb ).slice( 0, 3 ).join( ',' ) } ) }
				disableAlpha
			/>
		</PanelBody>
	</InspectorControls>;
};

export default Controls;

