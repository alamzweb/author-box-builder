(function(blocks, element, editor, components) {
	var el = element.createElement;
	var TextControl = components.TextControl;
	var InspectorControls = editor.InspectorControls;

	blocks.registerBlockType('author-box-builder/render-block', {
		title: 'Author Box',
		icon: 'admin-users',
		category: 'widgets',
		attributes: {
			selectedUser: {
				type: 'string',
				default: ''
			}
		},
		edit: function(props) {
			var attributes = props.attributes;

			return [
				el(InspectorControls, { key: 'controls' },
					el(components.PanelBody, { title: 'Configuration Metrics', initialOpen: true },
						el(TextControl, {
							label: 'Specify Target ID (Leave blank for contextual post author)',
							value: attributes.selectedUser,
							onChange: function(value) {
								props.setAttributes({ selectedUser: value });
							}
						})
					)
				),
				el('div', { className: 'abb-block-editor-placeholder', style: { padding: '20px', border: '2px dashed #ccc', textAlign: 'center' } },
					'👤 Author Box Widget Area (Outputs dynamically in frontend runtime environments for Author ID: ' + (attributes.selectedUser || 'Active Document Context Target') + ')'
				)
			];
		},
		save: function() {
			return null; // Render completely processed via backend operational pipelines
		}
	});
})(window.wp.blocks, window.wp.element, window.wp.editor, window.wp.components);