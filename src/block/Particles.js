import { useEffect, useRef } from 'react';
import CanvasNest from 'canvas-nest.js';

const Particles = ( { attributes } ) => {
	const ref = useRef();
	useEffect( function() {
		const cn = new CanvasNest( ref.current, attributes );
		return function() {
			cn.destroy();
		};
	}, [ attributes ] );
	return <div style={ { height: attributes.height } } ref={ ref } />;
};

export default Particles;
