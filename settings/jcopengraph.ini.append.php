<?php /*


[TagList]
OGTagList[]=title
OGTagList[]=description
OGTagList[]=keywords
OGTagList[]=author
OGTagList[]=og:type
OGTagList[]=og:title
OGTagList[]=og:image
OGTagList[]=og:description
OGTagList[]=og:site_name
OGTagList[]=og:latitude
OGTagList[]=og:longitude
OGTagList[]=og:street-address
OGTagList[]=og:locality
OGTagList[]=og:region
OGTagList[]=og:postal-code
OGTagList[]=og:country-name
OGTagList[]=og:email
OGTagList[]=og:phone_number
OGTagList[]=og:fax_number
OGTagList[]=og:video
OGTagList[]=og:video:height
OGTagList[]=og:video:width
OGTagList[]=og:video:type
OGTagList[]=og:audio
OGTagList[]=og:audio:title
OGTagList[]=og:audio:artist
OGTagList[]=og:audio:album
OGTagList[]=og:audio:type
OGTagList[]=fb:admins
OGTagList[]=fb:app_id
OGTagList[]=fb:page_id



# how the og attribute is generated
# disabled = tag is disabled
# manual = a field in object edition
# root = information is taken from site root object
# parent = information is taken from parent object 
# object_name = name of the content object for title
[title]
Name=Title
SelectionMethod=object_name

[description]
Name=Description

[keywords]
Name=Keywords

[author]	 
Name=Author

[og:type]
Name=Type
SelectionMethod=disabled

[og:title]
Name=Title (OpenGraph)
SelectionMethod=object_name

[og:image]
Name=Image
SelectionMethod=disabled
AllowManual=disabled
AllowManualOverride=disabled
WithFallback=enabled


[og:description]
Name=Description
SelectionMethod=manual

[og:site_name]
Name=Site Name
SelectionMethod=root
		
[og:latitude]
Name=Latitude

[og:longitude]
Name=Longitude

[og:street-address]
Name=Street

[og:locality]
Name=Locality

[og:region]
Name=Region

[og:postal-code]
Name=Postal code

[og:country-name]
Name=Country
		
[og:email]
Name=E-mail

[og:phone_number]
Name=Phone

[og:fax_number]
Name=Fax

[og:video]
Name=Video

[og:video:height]
Name=Video Height

[og:video:width]
Name=Video Width

[og:video:type]
Name=Video Type

[og:audio]
Name=Audio

[og:audio:title]
Name=Audio Title

[og:audio:artist]
Name=Audio Artist

[og:audio:album]
Name=Audio Album

[og:audio:type]
Name=Audio Type
	
[fb:admins]
Name=Facebook Admins
SelectionMethod=root

[fb:app_id]
Name=Facebook Application ID
SelectionMethod=root

[fb:page_id]
Name=Facebook Page ID
SelectionMethod=root

[OGTypeGroup]
OGTypeGroupList[]=websites
OGTypeGroupList[]=activity
OGTypeGroupList[]=business
OGTypeGroupList[]=groups
OGTypeGroupList[]=organizations
OGTypeGroupList[]=people
OGTypeGroupList[]=places
OGTypeGroupList[]=products

[OGTypeGroup_activity]
GroupName=Activity
OGTypeList[activity]=Activity
OGTypeList[sport]=Sport

[OGTypeGroup_business]
GroupName=Business
OGTypeList[bar]=Bar
OGTypeList[company]=Company
OGTypeList[cafe]=Cafe
OGTypeList[hotel]=Hotel
OGTypeList[restaurant]=Restaurant

[OGTypeGroup_groups]
GroupName=Groups
OGTypeList[cause]=Cause
OGTypeList[sports_league]=Sports league
OGTypeList[sports_team]=Sports team

[OGTypeGroup_organizations]
GroupName=Organizations
OGTypeList[band]=Band
OGTypeList[government]=Government
OGTypeList[non_profit]=Non Profit
OGTypeList[school]=School
OGTypeList[university]=University

[OGTypeGroup_people]
GroupName=People
OGTypeList[actor]=Actor
OGTypeList[athlete]=Athlete
OGTypeList[author]=Author
OGTypeList[director]=Director
OGTypeList[musician]=Musician
OGTypeList[politician]=Politician
OGTypeList[profile]=Profile
OGTypeList[public_figure]=Public figure

[OGTypeGroup_places]
GroupName=Places
OGTypeList[city]=City
OGTypeList[country]=Country
OGTypeList[landmark]=Landmark
OGTypeList[state_province]=State or Province

[OGTypeGroup_products]
GroupName=Products and Entertainment
OGTypeList[album]=Album
OGTypeList[book]=Book
OGTypeList[drink]=Drink
OGTypeList[food]=Food
OGTypeList[game]=Game
OGTypeList[movie]=Movie
OGTypeList[product]=Product
OGTypeList[song]=Song
OGTypeList[tv_show]=TV Show

[OGTypeGroup_websites]
GroupName=Websites
OGTypeList[article]=Article
OGTypeList[blog]=Blog
OGTypeList[website]=Website

*/ ?>