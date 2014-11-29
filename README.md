# Slugged 
Slugged is a Craft plugin that hashes the Id of an entry when it is saved and replaces the slug 

## Installation 
To install, copy the `slugged` directory to `craft > plugins` and install through the admin interface. To update, replace the `slugged` directory and refresh the admin area. 

## Configuration 
All configuration is done in the plugin settings page in the admin area. 

### Plugin settings 

**Salt** 
Set the salt to use when hashing

Default: ‘Change me to something’

***Default length*** 
The length of the hash, the default length of the hash this will be overwritten with any length defined for a section 

Default: `8`

***Alphabet*** 
The characters to use when generating the slug. 

Default: `abcdefghijklmnopqrstuvwxyz123456789`

***Sections*** 
The only sections that will be listed are editable sections that have their own urls. 

If you add a length to a section this will override the default set above. 

A section must be enabled for the hashing to happen, regardless of whether you add a length override or not. 

## Slugged fieldType
If you don’t want the entries slug to be replaced, Slugged also comes with a fieldType that you can use, this will work regardless of what section settings are enabled.

 
