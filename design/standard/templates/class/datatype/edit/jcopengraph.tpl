
{def $og_group_list=ezini('OGTypeGroup','OGTypeGroupList','jcopengraph.ini')
	 $class_attr_content=$class_attribute.content
	 $class_attribute_list=$#class.data_map}

{def $typeTag=$class_attr_content.og_tag_list['og:type']}

<table class="list">
	<tr>
		<th scope="col">{"OpenGraph Attribute"|i18n('jcopengraph/class/datatype')}</th>
		<th scope="col">{"Data source"|i18n('jcopengraph/class/datatype')}</th>
		<th scope="col">{"Allow manual override"|i18n('jcopengraph/class/datatype')}</th>
		<th scope="col">{"Secondary data source"|i18n('jcopengraph/class/datatype')}</th>
	</tr>
	<tr>
		<td>{'Object Type'|i18n( 'jcopengraph/class/datatype' )}</td>
		<td>
			<select name="ContentClass_jcog_selection_{$class_attribute.id}[og:type]">
				{foreach $og_group_list as $group_id}
					{def $type_list=ezini(concat('OGTypeGroup_',$group_id),'OGTypeList','jcopengraph.ini')}
					<optgroup label={ezini(concat('OGTypeGroup_',$group_id),'GroupName','jcopengraph.ini')|i18n('jcopengraph/types/groups')}>
						{foreach $type_list as $type => $name}
						<option value={$type} {if $typeTag.selection|eq($type)} selected="selected"{/if}>{$name|i18n('jcopengraph/types')}</option>
						{/foreach}
					</optgroup>
					{undef $type_list}
				{/foreach}
			</select>
		</td>
		<td>
			<input type="checkbox" name="ContentClass_jcog_manual_override_{$class_attribute.id}[og:type]" value="1" {if $typeTag.allow_manual_override} checked="checked"{/if}>
		</td>
		<td></td>
	</tr>


{foreach $class_attr_content.og_tag_list as $tag}
	{if $tag.tag|ne('og:type')}
		{*og:type is specific and managed before*}
	
		{set $authorized_datatype_list=$tag.authorized_datatype_list}
	<tr>
		<td>{$tag.name}</td>
		<td>
			<select name="ContentClass_jcog_selection_{$class_attribute.id}[{$tag.tag}]">

				<option value="jcop_disabled" {if $tag.selection|eq("jcop_disabled")} selected="selected"{/if}>{'Disabled'|i18n('jcopengraph/class/datatype')}</option>
				<option value="jcop_parent" {if $tag.selection|eq("jcop_parent")} selected="selected"{/if}>{'Parent value'|i18n('jcopengraph/class/datatype')}</option>
				<option value="jcop_root" {if $tag.selection|eq("jcop_root")} selected="selected"{/if}>{'Site root value'|i18n('jcopengraph/class/datatype')}</option>
				{if or($tag.tag|eq('og:title'),$tag.tag|eq('og:site_name'))}
					<option value="jcop_object_name" {if $tag.selection|eq("object_name")} selected="selected"{/if}>{'Content name'|i18n('jcopengraph/class/datatype')}</option>
				{/if}
				{if $tag.allow_manual}
					<option value="jcop_manual" {if $tag.selection|eq("jcop_manual")} selected="selected"{/if}>{'Manual'|i18n('jcopengraph/class/datatype')}</option>
				{/if}
				
				{foreach $class_attribute_list as $attribute}
					{if and($attribute.data_type_string|ne('jcopengraph'),or($authorized_datatype_list|count()|eq(0),$og_attribute_authorized_datatype|contains($attribute.data_type_string)))}
						<option value="{$attribute.identifier}" {if $attribute.identifier|eq($tag.selection)} selected="selected"{/if}>{$attribute.name}</option>
					{/if}
				{/foreach}
			</select>
		</td>
		<td>
			{if $tag.allow_manual}
			<input type="checkbox" name="ContentClass_jcog_manual_override_{$class_attribute.id}[{$tag.tag}]" value="1" {if $tag.allow_manual_override} checked="checked"{/if}>
			{/if}
		</td>
		<td>
			{if $tag.with_fallback}
			<select name="ContentClass_jcog_selection_fallback_{$class_attribute.id}[{$tag.tag}]">

				<option value="jcop_disabled" {if $tag.selection|eq("jcop_disabled")} selected="selected"{/if}>{'Disabled'|i18n('jcopengraph/class/datatype')}</option>
				<option value="jcop_parent" {if $tag.selection|eq("jcop_parent")} selected="selected"{/if}>{'Parent value'|i18n('jcopengraph/class/datatype')}</option>
				<option value="jcop_root" {if $tag.selection|eq("jcop_root")} selected="selected"{/if}>{'Site root value'|i18n('jcopengraph/class/datatype')}</option>
				{if or($tag.tag|eq('og:title'),$tag.tag|eq('og:site_name'))}
					<option value="jcop_object_name" {if $tag.selection|eq("object_name")} selected="selected"{/if}>{'Content name'|i18n('jcopengraph/class/datatype')}</option>
				{/if}
				{if $tag.allow_manual}
					<option value="jcop_manual" {if $tag.selection|eq("jcop_manual")} selected="selected"{/if}>{'Manual'|i18n('jcopengraph/class/datatype')}</option>
				{/if}
				
				{foreach $class_attribute_list as $attribute}
				
					{if and($attribute.data_type_string|ne('jcopengraph'),or($authorized_datatype_list|count()|eq(0),$og_attribute_authorized_datatype|contains($attribute.data_type_string)))}
						<option value="{$attribute.identifier}" {if $attribute.identifier|eq($tag.selection)} selected="selected"{/if}>{$attribute.name}</option>
					{/if}
				{/foreach}
			</select>
			{/if}
		</td>
	</tr>
	{/if}

{/foreach}
</table>

