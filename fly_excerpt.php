<?php
$plugin['name'] = 'fly_excerpt';
$plugin['allow_html_help'] = 1;
$plugin['version'] = '1.0';
$plugin['author'] = 'Superfly';
$plugin['author_uri'] = 'http://www.flyweb.at';
$plugin['description'] = 'Truncate Article Excerpt';
$plugin['order'] = '5';
$plugin['type'] = '0';
$plugin['flags'] = '0';

# --- BEGIN PLUGIN CODE ---
/**
 *
 * Textpattern CMS Plugin <www.textpattern.com>
 *
 * fw_excerpt.php
 * Flyweb Article Excerpt Plugin
 *
 * This Plugin provides the <txp:fly_excerpt /> Tag for the Textpattern Frontend. It will output the
 * Article-Excerpt words truncated to the given Attribute number.
 *
 * @author flyweb productions <www.flyweb.at>
 * @copyright 2015 flyweb productions
 * @license http://opensource.org/licenses/MIT - MIT License (MIT)
 * @version 1.1 <https://github.com/brachycera/fly_excerpt>
 *
 */

/*
 *
 * fw_excerpt - Trim article excerpt to given words
 *
 * @param array $atts - num     $truncate - How many words should be truncated - Default: 10
 *                    	boolean $link - Show $more as HTML Link Values 0(no) or 1(yes) Default: 0
 *                     	string  $more - String to show User there is more content. Default: ...
 *                      string  $class - Optional HTML Class Name for $more Link
 * @return string $excerpt
 *
 */
function fly_excerpt($atts){

	global $thisarticle;

	extract(
		lAtts(
			array(
				'truncate' => '',
				'class'      => '',
				'more'       => '',
				'link'       => ''
	      	),
	      	$atts
		)
	);


	( empty($truncate) ? $truncate = 10 : $truncate );

	( empty($class) ? $class : $class = ' class="' . $class . '"' );

	( empty($more) ? $more = '...' : $more );

    ( ($link) ? $more = href( $more, permlinkurl($thisarticle), $class) : $more );

	$excerpt = $thisarticle['excerpt'];

	$matches = preg_split( "/\s+/", $excerpt, $truncate + 1 );

	$words = count( $matches );

	if ( $words > $truncate ) {

		unset( $matches[$words - 1] );

		return implode(' ', $matches) . ' ' . $more;

	}

	return $excerpt;

}
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
<h1>Excerpt Trunction</h1>
<p>This Plugin can truncate the words shown from an article excerpt.</p>
<h2>Usage</h2>
<p>After installing you can use the <code>&lt;txp:fly_excerpt /&gt;</code> Tag.</p>
<h3>Attributes</h3>
<ul>
<li><code>truncate</code> - How many words should be truncated - Default: 10</li>
<li><code>more</code> - String to show User there is more content. Default: ...</li>
<li><code>link</code> - Show "more" String as HTML Link. Values 0(no) or 1(yes). Default: 0</li>
<li><code>class</code> - Optional HTML Class Name for "more" String Link</li>
</ul>
<h2>Changelog</h2>
<p><strong>Version 1.0</strong> Initial release -  16. Feb. 2015</p>
<br><br><br><br><br><hr><p align="center"><small>This Plugin was made by <a href="http://www.flyweb.at"> flyweb Productions</a>.</small></p>
# --- END PLUGIN HELP ---
-->
<?php
}
?>