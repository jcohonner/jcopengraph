<?php


class jcOpenGraphClassAttribute extends jcObject
{


	/**
	 * constructor
	 */
	function __construct()
	{
		$this->OpenGraphTagList = array();
		
		$ini = eZINI::instance('jcopengraph.ini');
		$TagList=$ini->variable('TagList','OGTagList');
		foreach ($TagList as $tagID)
		{
			$name=$ini->variable($tagID,'Name');
			$selectionMethod=$ini->hasVariable($tagID,'SelectionMethod')?$ini->variable($tagID,'SelectionMethod'):jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_DISABLED;
			$allowOverride=($ini->hasVariable($tagID,'AllowManual') && $ini->variable($tagID,'AllowManual')=='disabled')?false:true;
			$allowManualOverride=($ini->hasVariable($tagID,'AllowManualOverride') && $ini->variable($tagID,'AllowManualOverride')=='enabled')?true:false;
			$withFallback=($ini->hasVariable($tagID,'WithFallback') && $ini->variable($tagID,'WithFallback')=='enabled')?true:false;
			
			$this->OpenGraphTagList[$tagID]=new jcOpenGraphClassAttributeTag($tagID,$name,$selectionMethod,$allowOverride,$allowManualOverride,$withFallback);
		}
	}
	
	/**
	 * returns object definition
	 * @return array
	 */
	function definition()
	{
		static $definition = array(	'fields'				=> array('og_tag_list'=>'OpenGraphTagList'),
 									'function_attributes' 	=> array(),
 									'class_name'			=> 'jcOpenGraphClassAttribute'
	 								);
		return $definition;
	}
	
	
	/**
	 * initialize object from XML
	 * @var string $XML 
	 */
	function decodeClassAttributeXML($XML)
	{
	    $dom = new DOMDocument( '1.0', 'utf-8' );
        $success = $dom->loadXML( $XML );

        if ( $success )
        {
          	foreach ($dom->getElementsByTagName( 'ogtag' ) as $tag)
            {
            	$tagID = $tag->getAttribute('tag_id');
            	if (isset( $this->OpenGraphTagList[$tagID]) )
            	{
            		$this->OpenGraphTagList[$tagID]->decodeClassAttributeNode($tag);
            	}
            }
        }
	}

	
	/**
	 * returns class attribute xml definition
	 * @return string
	 */
	function classAttributeToXML()
	{
		$doc = new DOMDocument( '1.0', 'utf-8' );

        $root = $doc->createElement( "jcogclassattribute" );
        $doc->appendChild( $root );

        foreach ( $this->OpenGraphTagList as $tag )
        {
            unset( $itemNode );
           	$itemNode = $tag->getClassAttributeXMLNode($doc);
            $root->appendChild( $itemNode );
        }
        
        $xml = $doc->saveXML();

        return $xml;
	}
	
	
	
	
	protected $OpenGraphTagList;

	
	
}