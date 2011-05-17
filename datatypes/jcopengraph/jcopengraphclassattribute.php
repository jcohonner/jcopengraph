<?php


class jcOpenGraphClassAttribute extends jcObject
{


	/**
	 * constructor
	 */
	function __construct()
	{
		$this->OpenGraphTagList = array();
		
		//Main tags
		$this->OpenGraphTagList['og:type'] = new jcOpenGraphClassAttributeTag('og:type','Type',jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_NAME);
		$this->OpenGraphTagList['og:title'] = new jcOpenGraphClassAttributeTag('og:title','Title',jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_MANUAL);
		$this->OpenGraphTagList['og:image'] = new jcOpenGraphClassAttributeTag('og:image','Image',false,false,false,true);
		$this->OpenGraphTagList['og:description'] = new jcOpenGraphClassAttributeTag('og:description','Description',jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_MANUAL);
		$this->OpenGraphTagList['og:site_name'] = new jcOpenGraphClassAttributeTag('og:site_name','Site Name',jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_ROOT);
		
		//Location
		$this->OpenGraphTagList['og:latitude'] = new jcOpenGraphClassAttributeTag('og:latitude','Latitude');
		$this->OpenGraphTagList['og:longitude'] = new jcOpenGraphClassAttributeTag('og:longitude','Longitude');
		$this->OpenGraphTagList['og:street-address'] = new jcOpenGraphClassAttributeTag('og:street-address','Street');
		$this->OpenGraphTagList['og:locality'] = new jcOpenGraphClassAttributeTag('og:locality','Locality');
		$this->OpenGraphTagList['og:region'] = new jcOpenGraphClassAttributeTag('og:region','Region');
		$this->OpenGraphTagList['og:postal-code'] = new jcOpenGraphClassAttributeTag('og:postal-code','Postal code');
		$this->OpenGraphTagList['og:country-name'] = new jcOpenGraphClassAttributeTag('og:country-name','Country');
		
		//Contact
		$this->OpenGraphTagList['og:email'] = new jcOpenGraphClassAttributeTag('og:email','E-mail');
		$this->OpenGraphTagList['og:phone_number'] = new jcOpenGraphClassAttributeTag('og:phone_number','Phone');
		$this->OpenGraphTagList['og:fax_number'] = new jcOpenGraphClassAttributeTag('og:fax_number','Fax');
		
		//Video
		$this->OpenGraphTagList['og:video'] = new jcOpenGraphClassAttributeTag('og:video','Video');
		$this->OpenGraphTagList['og:video:height'] = new jcOpenGraphClassAttributeTag('og:video:height','Video Height');
		$this->OpenGraphTagList['og:video:width'] = new jcOpenGraphClassAttributeTag('og:video:width','Video Width');
		$this->OpenGraphTagList['og:video:type'] = new jcOpenGraphClassAttributeTag('og:video:type','Video Type');

		//Audio
		$this->OpenGraphTagList['og:audio'] = new jcOpenGraphClassAttributeTag('og:audio','Audio');
		$this->OpenGraphTagList['og:audio:title'] = new jcOpenGraphClassAttributeTag('og:audio:title','Audio Title');
		$this->OpenGraphTagList['og:audio:artist'] = new jcOpenGraphClassAttributeTag('og:audio:artist','Artist');
		$this->OpenGraphTagList['og:audio:album'] = new jcOpenGraphClassAttributeTag('og:audio:album','Album');
		$this->OpenGraphTagList['og:audio:type'] = new jcOpenGraphClassAttributeTag('og:audio:type','Type');
	
		//FaceBook
		$this->OpenGraphTagList['fb:admins'] = new jcOpenGraphClassAttributeTag('fb:admins','Facebook Admins',jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_ROOT);
		$this->OpenGraphTagList['fb:app_id'] = new jcOpenGraphClassAttributeTag('fb:app_id','Facebook Application ID',jcOpenGraphClassAttributeTag::TAG_SELECTION_METHOD_ROOT);
	
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