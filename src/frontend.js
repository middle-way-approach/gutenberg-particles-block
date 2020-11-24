const defaultAttributes = {
	color: '0,0,0',
	pointColor: '0,0,0',
	opacity: 0.5,
	count: 99,
	zIndex: '0',
};

const elements = document.getElementsByClassName( 'particles' );

for ( let i = 0; i < elements.length; i++ ) {
	const element = elements[ i ];
	const attributes = JSON.parse( element.dataset.options );
	// eslint-disable-next-line no-undef
	new CanvasNest( element, { ...defaultAttributes, ...attributes } );
}
