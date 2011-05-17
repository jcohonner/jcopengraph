<?php
/**
 * 
 * @author Jérôme Cohonner
 *
 */
class jcOpenGraphType extends eZDataType
{

    const DATA_TYPE_STRING = "jcopengraph";

	/**
	 * constructor
	 */
    function jcOpenGraphType()
    {
        $this->eZDataType( self::DATA_TYPE_STRING, ezpI18n::tr("jcopengraph/class/datatype","OpenGraph") );
    }
    
    /**
     * Validates all variables given on content class level
     * @return mixed eZInputValidator::STATE_ACCEPTED or eZInputValidator::STATE_INVALID
     */
    function validateClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    /**
     * Fetches all variables inputed on content class level
     * @return boolean
     */
    function fetchClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
    	$classAttributeID = $classAttribute->attribute('id');
    	$selectionMethodArray = $http->postVariable('ContentClass_jcog_selection_'.$classAttributeID);
    	$selectionManualOverrideArray = $http->postVariable('ContentClass_jcog_manual_override_'.$classAttributeID);
    	if ( !is_array($selectionManualOverrideArray) ) $selectionManualOverrideArray=array();
    	$selectionFallbackArray = $http->postVariable('ContentClass_jcog_selection_fallback_'.$classAttributeID);

    	
		/*
		 * get current content (even default one) from attribute
		 */    	
    	$content = $classAttribute->attribute('content');
    	$tmpTagList = $content->attribute('og_tag_list');
    	
    	foreach ( $content->attribute('og_tag_list') as $tagID => $tag )
    	{
    		
    		if ( isset($selectionMethodArray[$tagID]) )
    		{
    			$tag->setAttribute('selection',$selectionMethodArray[$tagID]);
    		}
    			
    		if ( isset($selectionManualOverrideArray[$tagID]) )
    		{
    			$tag->setAttribute('allow_manual_override',true);
    		} else {
    			$tag->setAttribute('allow_manual_override',false);
    		}
    		
    		if ( isset($selectionFallbackArray[$tagID]) )
    		{
    			$tag->setAttribute('selection_fallback',$selectionFallbackArray[$tagID]);
    		}	
    		
    		$tmpTagList[$tagID] = $tag;
    	}
    	
    	$content->setAttribute('og_tag_list',$tmpTagList);
    	
    	
    	//Set class attribute data 
    	$classAttribute->setAttribute('data_text5',$content->classAttributeToXML());
    	
        return true;
    }
    
    
    
    /*!
     Validates input on content object level
     \return eZInputValidator::STATE_ACCEPTED or eZInputValidator::STATE_INVALID if
             the values are accepted or not
    */
    function validateObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        return eZInputValidator::STATE_ACCEPTED;
    }

    /*!
     Fetches all variables from the object
     \return true if fetching of class attributes are successfull, false if not
    */
    function fetchObjectAttributeHTTPInput( $http, $base, $contentObjectAttribute )
    {
        return true;
    }

    /*!
     Returns the class content
    */
    function classAttributeContent( $classAttribute )
    {
    	$jcOGCA = new jcOpenGraphClassAttribute();
    	$jcOGCA->decodeClassAttributeXML($classAttribute->attribute('data_text5'));
        return $jcOGCA;
    }
    /*!
     Returns the content.
    */
    function objectAttributeContent( $contentObjectAttribute )
    {
        return "";
    }

    /*!
     Returns the meta data used for storing search indeces.
    */
    function metaData( $contentObjectAttribute )
    {
        return "";
    }

    /*!
     Returns the value as it will be shown if this attribute is used in the object name pattern.
    */
    function title( $contentObjectAttribute, $name = null )
    {
        return "";
    }

    /*!
     \return true if the datatype can be indexed
    */
    function isIndexable()
    {
        return true;
    }

}

eZDataType::register( jcOpenGraphType::DATA_TYPE_STRING, "jcOpenGraphType" );
?>
