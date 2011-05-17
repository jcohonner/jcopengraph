<?php


class jcOpenGraphClassAttributeTag extends jcObject
{

	/*
	 * how the og attribute is generated
	 * disabled = tag is disabled
	 * manual = a field in object edition
	 * root = information is taken from site root object
	 * parent = information is taken from parent object 
	 * object_name = name of the content object for title
	 */
	const TAG_SELECTION_METHOD_DISABLED = 'jcop_disabled';
	const TAG_SELECTION_METHOD_MANUAL	= 'jcop_manual';
	const TAG_SELECTION_METHOD_ROOT		= 'jcop_root';
	const TAG_SELECTION_METHOD_PARENT	= 'jcop_parent';
	const TAG_SELECTION_METHOD_NAME		= 'jcop_object_name';
	
	
	/**
	 * constructor
	 * @var string $Tag og tag
	 * @var string $TagName (before i18n)
	 * @var string $Selection selection method
	 * @var boolean $AllowManual is manual possible
	 * @var boolean $AllowManualOverride is manual override on content edit is enabled
	 * @var boolean $WithFallback can we add a second selection method
	 */
	function __construct($Tag,$TagName,$Selection=self::TAG_SELECTION_METHOD_DISABLED,$AllowManual=true,$AllowManualOverride=false,$WithFallback=false)
	{
		$this->Tag = $Tag;
		$this->TagName = ezpI18n::tr( 'jcopengraph/ogTagNames' , $TagName );
		$this->Selection = $Selection;
		$this->AllowManual = $AllowManual;
		$this->WithFallback = $WithFallback;
		$this->AllowManualOverride = $AllowManualOverride;
		$this->SelectionFallback = false;
	}
	
	/**
	 * returns object definition
	 * @return array
	 */
	function definition()
	{
		static $definition = array(	'fields'				=> array(	'tag' => 'Tag',
																		'name' => 'TagName',
																		'selection' => 'Selection',
																		'allow_manual' => 'AllowManual',
																		'with_fallback' => 'WithFallback',
																		'allow_manual_override' => 'AllowManualOverride',
																		'selection_fallback' => 'SelectionFallback'),
 									'function_attributes' 	=> array('authorized_datatype_list'=>'authorizedDataTypeList'),
 									'class_name'			=> 'jcOpenGraphClassAttributeTag'
	 								);
		return $definition;
	}
	
	/**
	 * return DOMNode element for this tag
	 * @var DOMDocument $doc
	 * @return DOMNode 
	 */
	function getClassAttributeXMLNode(DOMDocument $doc)
	{
		$itemNode = $doc->createElement( 'ogtag' );
		
		$itemNode->setAttribute( "tag_id", 					$this->Tag );
		$itemNode->setAttribute( "selection", 				$this->Selection );
		$itemNode->setAttribute( "selection_fallback", 		$this->SelectionFallback?$this->SelectionFallback:'disabled');
		$itemNode->setAttribute( "allow_manual_override", 	$this->AllowManualOverride?'enabled':'disabled');

		return $itemNode;	
	}
	
	/**
	 * decode an XML node to initialize class attribute
	 * @var DOMNode $node
	 */
	function decodeClassAttributeNode(DOMNode $node)
	{
		$this->Selection = $node->getAttribute( "selection" );
		$this->SelectionFallback = $node->getAttribute( "selection_fallback" )=='disabled'?false:$node->getAttribute( "selection_fallback" );
		$this->AllowManualOverride = $node->getAttribute( "allow_manual_override" )=='enabled'?true:false;
	}
	
	
	/**
	 * returns the list of authorized datatypes for this element type
	 * array() == all
	 * return array[string]
	 */
	function authorizedDataTypeList()
	{
		return array();
	}
	
	protected $Tag;
	protected $Title;
	protected $Selection;
	protected $SelectionFallback=false;
	protected $AllowManualOverride;
	protected $WithFallback;
	
	
}