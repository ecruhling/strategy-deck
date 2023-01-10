import { useBlockProps } from '@wordpress/block-editor';
import { blockStyle } from './index';

export const Save = ( { attributes } ) => {
	return (
		<div { ...useBlockProps.save( { style: { ...blockStyle } } ) }>
			<p className={ 'has-link-color' }>
				Hello World, WordPress Plugin Boilerplate Powered here!
			</p>
		</div>
	);
};
