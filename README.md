# Craft 3

If you're looking for a Craft 3 version, this has been ported over by https://github.com/madmadmad/slugger, so be sure to use that instead.

# Slugged 
Slugged is a Craft plugin that hashes the Id of an entry when it is saved and replaces the slug

This plugin uses the [Hashids](http://hashids.org/php/) library to generate the slugs.

## Installation 
To install, copy the `slugged` directory to `craft > plugins` and install through the admin interface. To update, replace the `slugged` directory and refresh the admin area. 

## Configuration 
All configuration is done in the plugin settings page in the admin area. 

### Plugin settings 

***Salt***  
Set the salt to use when hashing

Default: `Change me to something`

***Default length***   
The length of the hash, this will be overwritten with any length defined for a section 

Default: `8`

***Alphabet***  
The characters to use when generating the slug. 

Default: `abcdefghijklmnopqrstuvwxyz123456789`

***Sections***  
The only sections that will be listed are editable sections that have their own urls. If you add a length to a section this will override the default set above. A section must be enabled for the hashing to happen, regardless of whether you add a length override or not. 

## Slugged fieldType
If you don’t want the entries slug to be replaced, Slugged also comes with a fieldType that you can use, this will work regardless of what section settings are enabled.

### Hidden asset download example
You can use the slugged field type to hide the download path of an asset, or just to provide an easier to remember/share url.

- Add a route to craft via `admin > settings > routes`, I will be using a `_trigger.html` template in a folder called `download` so my route looks like this: `download/*` and the template to load: `download/_trigger`

- Create a slugged field type and attach it to the asset source using the layout designer

On one of my assets, the field type value is `9ow1LmwN`,  so I will be using that for this example.

my url looks like this: `http://alec.dev/download/9ow1LmwN`

**download/_trigger.html**
```
  {# get the hash value from the url #}
  {% set hash = craft.request.segment(2) %}
    
  {# use slugged’s decode method to get the ID #}
  {% set assetId = craft.slugged.decode(hash) %}

  {# Get the first asset with the id #}
  {% set asset = craft.assets.id(assetId).first %}
    
  {# if there is an asset, redirect to its download url, otherwise throw a 404 #}
  {% if asset is defined and asset|length %}
        {% redirect asset.getUrl() %}
  {% else %}
    {% redirect "404" %}
  {% endif %}
```

## Support, issues, feedback

If you want to leave feedback about this project, feel free to get in touch on [twitter](https://twitter.com/alecritson) if you experience any issues please just create a new issue here on the Repo
