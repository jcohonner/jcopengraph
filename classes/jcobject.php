<?php

/**
 * File containing the jcObject class.
 * tested with eZ Publish 4.4.0 Enterprise
 * @author Jérôme Cohonner <jc@ez.no>
 * @version 1.0.0
 * @package jcopengraph
 */

/**
 * This utility class is used to help any object to be compatible with template language
 */
class jcObject 
{
	
	
	/**
	 * returns a basic definition (simpliest than eZPersistentObject) to manage a simple "attribute" function
	 * 
	 * 		static $definition = array(	'fields'				=> array('sort_by'=>'SortBy'),
	 *									'function_attributes' 	=> array('item_list'=>'itemList'),
	 *									'class_name'			=> 'class'
	 *								);
	 * @return array
	 */
	function definition()
	{
		return array('fields'=>array(),'function_attributes'=>array());
	}
	
	/**
	 * returns the list of available attributes
	 * @return unknown_type
	 */
	function attributes()
	{
		$definition = $this->definition();
		return array_merge(array_keys($definition['fields']),array_keys($definition['function_attributes']));
	}
	
	/**
	 * returns true if the attribut exists
	 * @param $name
	 * @return boolean
	 */
	function hasAttribute($name)
	{
		return in_array($name,$this->attributes());
	}
	
	/**
	 * returns attribute value
	 * @param $name attribute name
	 * @param boolean $noFunction
	 * @return mixed
	 */
    function attribute( $attr, $noFunction = false )
    {
        $def = $this->definition();
        $fields = $def["fields"];
        $attrFunctions = isset( $def["function_attributes"] ) ? $def["function_attributes"] : null;
        if ( $noFunction === false and isset( $attrFunctions[$attr] ) )
        {
            $functionName = $attrFunctions[$attr];
            $retVal = null;
            if ( method_exists( $this, $functionName ) )
            {
                $retVal = $this->$functionName();
            }
            else
            {
                eZDebug::writeError( 'Could not find function : "' . get_class( $this ) . '::' . $functionName . '()".',
                                     'dfObject::attribute()' );
            }
            return $retVal;
        }
        else if ( isset( $fields[$attr] ) )
        {
            $attrName = $fields[$attr];
            return $this->$attrName;
        }
        else
        {
            eZDebug::writeError( "Attribute '$attr' does not exist", $def['class_name'] . '::attribute' );
            $attrValue = null;
            return $attrValue;
        }
    }
	
    
	/**
	 * sets attribute value 
	 * @param string $attr
	 * @param mixed $val
	 */
    function setAttribute( $attr, $val )
    {
        $def = $this->definition();
        $fields = $def["fields"];
        $functions = isset( $def["set_functions"] ) ? $def["set_functions"] : null;
        if ( isset( $fields[$attr] ) )
        {
            $attrName = $fields[$attr];
            if ( is_array( $attrName ) )
            {
                $attrName = $attrName['name'];
            }
            
            $this->$attrName=$val;
        }
        else if ( isset( $functions[$attr] ) )
        {
            $oldValue = $this->$functionName( $val );
        }
        else
        {
            eZDebug::writeError( "Undefined attribute '$attr', cannot set",
                                 $def['class_name'] );
        }
    }
    
}