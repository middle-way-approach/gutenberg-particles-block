import Particles from './Particles';
import Controls from './Controls';

const Edit = ( props ) => {
	return <div className={ props.className }>
		<Particles { ...props } />
		<Controls { ...props } />
	</div>;
};

export default Edit;
