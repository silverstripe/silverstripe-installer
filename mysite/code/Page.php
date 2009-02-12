<?php

class Page extends SiteTree {
	
	public static $db = array(
	);
	
	public static $has_one = array(
	);
	
}

class Page_Controller extends ContentController {
	
	public function init() {
		parent::init();

		// Note: you should use <% require %> tags inside your templates instead of putting Requirements calls here.  However
		// these are included so that our older themes still work
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
	
	function TestForm() {
		
		$fields = new FieldSet(
	      	new TextField("Title", "Title"),
			new TextareaField("Message", "Message")
	  	);
		$actions = new FieldSet(
	      	new FormAction('doTestForm', 'Submit')
	  	);

	  	$form = new Form($this, "TestForm", $fields, $actions);
	

	
		if(class_exists('SpamProtecterManager')) { 
			$protecter = SpamProtecterManager::update_form($form); 
			$protecter->setFieldMapping('Title', 'Message');
		}
	
		return $form;
	}
	
	function doTestForm($data, $form) {
		Director::redirectBack();
	}
}

?>