/*
---

name: MooEditable.Extras

description: Extends MooEditable to include more (simple) toolbar buttons.

license: MIT-style license

authors:
- Lim Chee Aun
- Ryan Mitchell

requires:
# - MooEditable
# - MooEditable.UI
# - MooEditable.UI.MenuList

provides: 
- MooEditable.Actions.formatBlock
- MooEditable.Actions.justifyleft
- MooEditable.Actions.justifyright
- MooEditable.Actions.justifycenter
- MooEditable.Actions.justifyfull
- MooEditable.Actions.removeformat
- MooEditable.Actions.insertHorizontalRule

...
*/

MooEditable.Locale.define({
	blockFormatting: 'Formato de Bloque',
	paragraph: 'Párrafo',
	heading1: 'Heading 1',
	heading2: 'Título',
	heading3: 'SubTítulo',
	heading4: 'Estilo 1',
	heading5: 'Estilo 2',
	heading6: 'Estilo 3',
	alignLeft: 'Alinear a la Izquierda',
	alignRight: 'Alinear a la Derecha',
	alignCenter: 'Centrar',
	alignJustify: 'Justificar',
	removeFormatting: 'Remover formato',
	insertHorizontalRule: 'Insertar Línea Horizontal'
});

Object.append(MooEditable.Actions, {

	formatBlock: {
		title: MooEditable.Locale.get('blockFormatting'),
		type: 'menu-list',
		options: {
			list: [							
				{text: MooEditable.Locale.get('paragraph'), value: 'p'},
				//{text: MooEditable.lang.get('heading1'), value: 'h1', style: 'font-size:24px; font-weight:bold;'},
				{text: MooEditable.Locale.get('heading2'), value: 'h2', style: 'font-size:20px; font-weight:bold; color:#222;'},
				{text: MooEditable.Locale.get('heading3'), value: 'h3', style: 'font-size:18px; font-weight:bold; color:#111;'},
				{text: MooEditable.Locale.get('heading4'), value: 'h4', style: 'font-size:16px; font-weight:bold; color:#000;'},
				{text: MooEditable.Locale.get('heading5'), value: 'h5', style: 'font-size:14px; font-weight:bold; color:#000;'},
				{text: MooEditable.Locale.get('heading6'), value: 'h6', style: 'font-size:14px; font-weight:bold; color:#222;'}				
			]
		},
		states: {
			tags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
		},
		command: function(menulist, name){
			var argument = '<' + name + '>';
			this.focus();
			this.execute('formatBlock', false, argument);
		}
	},
	
	justifyleft:{
		title: MooEditable.Locale.get('alignLeft'),
		states: {
			css: {'text-align': 'left'}
		}
	},
	
	justifyright:{
		title: MooEditable.Locale.get('alignRight'),
		states: {
			css: {'text-align': 'right'}
		}
	},
	
	justifycenter:{
		title: MooEditable.Locale.get('alignCenter'),
		states: {
			tags: ['center'],
			css: {'text-align': 'center'}
		}
	},
	
	justifyfull:{
		title: MooEditable.Locale.get('alignJustify'),
		states: {
			css: {'text-align': 'justify'}
		}
	},
	
	removeformat: {
		title: MooEditable.Locale.get('removeFormatting')
	},
	
	insertHorizontalRule: {
		title: MooEditable.Locale.get('insertHorizontalRule'),
		states: {
			tags: ['hr']
		},
		command: function(){
			this.selection.insertContent('<hr>');
		}
	}

});
