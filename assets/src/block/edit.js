import {
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';
import { blockStyle } from './index';

export const Edit = ( { isSelected, style, attributes, setAttributes } ) => {
	return (
		<div
			{ ...useBlockProps( {
				style: { ...blockStyle, style },
			} ) }
		>
			<InspectorControls key="setting">
				<Panel header="Settings">
					<PanelBody
						title="Block Settings"
						icon={ 'settings' }
						initialOpen={ true }
					>
						<PanelRow>
							<TextControl
								label="Test"
								type={ 'url' }
								// value={ attributes.href }
								// onChange={ ( target ) =>
								// 	setAttributes( { href: target } )
								// }
							/>
						</PanelRow>
					</PanelBody>
				</Panel>
			</InspectorControls>
			<RichText
				tagName="p"
				value={ attributes.word }
				onChange={ ( word ) => setAttributes( { word } ) }
				placeholder={ 'Word' }
				style={
					isSelected
						? { border: '2px solid red' }
						: { border: 'none' }
				}
			/>
		</div>
	);
};
