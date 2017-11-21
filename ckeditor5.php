<?php
/**
 *
 * Plugin	CKEditor
 * @author	Stephane F
 *
 **/

class ckeditor5 extends plxPlugin {

	public $valid_path = false;

	/**
	 * Constructeur de la classe ckeditor
	 *
	 * @param	default_lang	langue par défaut utilisée par PluXml
	 * @return	null
	 * @authors	Stephane F
	 **/
	public function __construct($default_lang) {

		# Appel du constructeur de la classe plxPlugin (obligatoire)
		parent::__construct($default_lang);

		# droits pour accéder à la page config.php du plugin
		$this->setConfigProfil(PROFIL_ADMIN);

		# déclaration pour ajouter l'éditeur
		$static = $this->getParam('static')==1 ? '' : '|statique';
		if(!preg_match('/(parametres_edittpl|comment'.$static.')/', basename($_SERVER['SCRIPT_NAME']))) {
			$this->addHook('AdminTopEndHead', 'AdminTopEndHead');
			$this->addHook('AdminFootEndBody', 'AdminFootEndBody');
		}

	}

	/**
	 * Méthode qui ajoute la déclaration du script javascript de ckeditor dans la partie <head>
	 *
	 * @return	stdio
	 * @author	Stephane F
	 **/
	public function AdminTopEndHead() {

		echo '<script src="'.PLX_PLUGINS.'ckeditor5/ckeditor/ckeditor.js"></script>'."\n";
		echo '<style>.ck-editor__editable { min-height: 400px; }</style>'."\n";

	}

	/**
	 * Méthode qui ajoute la déclaration du script javascript de ckeditor en bas de page
	 *
	 * @return	stdio
	 * @author	Stephane F
	 **/
	public function AdminFootEndBody() {
		?>
		<script>
		var textareas = document.getElementsByTagName("textarea");
		for(var i=0;i<textareas.length;i++) {
			var n = textareas[i].name;
			if(n=="content" || n=="chapo") {
				var ed = ClassicEditor.create(document.querySelector('#id_'+n), {
					toolbar: [ 'headings', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
					heading: {
						options: [
							{ modelElement: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
							{ modelElement: 'heading1', viewElement: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
							{ modelElement: 'heading2', viewElement: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
							{ modelElement: 'heading3', viewElement: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
						]
					}
				});
			}
		}

		</script>
	<?php
	}
}
?>
