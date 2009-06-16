<?php

class Page extends SiteTree {
	
	static $api_access = true;
	
	public static $db = array(
		'AdditionalProperty' => 'Text', 
	);
	
	public static $has_one = array(
	);
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
	
		if($this->hasExtension('Translatable')) {
			$translation = $this->getTranslation(Translatable::default_locale());
			$transformation = new Translatable_Transformation($translation);
			$additionalField = $transformation->transformFormField(
				new TextField('AdditionalProperty')
			);
			$fields->addFieldToTab('Root.Content.Main', $additionalField);
		}
		
		return $fields;
	}
	
}

class Page_Controller extends ContentController {
	
	public function init() {
		parent::init();

		// Note: you should use SS template require tags inside your templates
		// instead of putting Requirements calls here.  However these are
		// included so that our older themes still work
		Requirements::themedCSS("layout"); 
		Requirements::themedCSS("typography"); 
		Requirements::themedCSS("form"); 
	}
	
	/**
	 * Site search form 
	 */ 
	function SearchForm() {
		$searchText = isset($_REQUEST['Search']) ? $_REQUEST['Search'] : 'Search';
		$fields = new FieldSet(
	      	new TextField("Search", "", $searchText)
	  	);
		$actions = new FieldSet(
	      	new FormAction('results', 'Search')
	  	);

	  	return new SearchForm($this, "SearchForm", $fields, $actions);
	}
	
	/**
	 * Process and render search results
	 */
	function results($data, $form){
	  	$data = array(
	     	'Results' => $form->getResults(),
	     	'Query' => $form->getSearchQuery(),
	      	'Title' => 'Search Results'
	  	);

	  	return $this->customise($data)->renderWith(array('Page_results', 'Page'));
	}
	
}

?>