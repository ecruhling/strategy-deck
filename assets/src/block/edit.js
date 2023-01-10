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
								label="Columns"
								type={ 'integer' }
								value={ attributes.columns }
								onChange={ ( columns ) =>
									setAttributes( { columns } )
								}
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
						? { border: '1px dashed black' }
						: { border: 'none' }
				}
			/>
		</div>
	);
};
