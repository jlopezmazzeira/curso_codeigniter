<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Richtext
 *
 * A helper for richtext of blog
 *
 * @package		DevelopersAzteca
 * @author		Nekszer And Steveathon
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		https://github.com/steveathon/bootstrap-wysiwyg/blob/master/LICENSE
 * @link		https://github.com/steveathon/bootstrap-wysiwyg/
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * DevelopersAzteca Input Helper
 *
 * @package		DevelopersAzteca
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Nekszer And Steveathon
 * @link		https://github.com/steveathon/bootstrap-wysiwyg/
 */

// ------------------------------------------------------------------------

/**
 * Este método crea un richbox
 *
 * @access	public
 * @param	string 		= title of richtext
 * @return	string
 */
if ( ! function_exists('generate_rich_box'))
{
	function generate_rich_box($title = '')
	{
		echo "<h2>". $title ."</h2>";

		echo '<div class="hero-unit">
			<div class="pull-right"></div>
			<hr />
			<div id="alerts"></div>
			<div class="btn-toolbar" data-role="editor-toolbar"
				data-target="#editor">
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
						title="Font"><i class="icon-font"></i><b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
					</ul>
				</div>
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
						title="Font Size"><i class="icon-text-height"></i>&nbsp;<b
						class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a data-edit="fontSize 5"><font size="5">Huge</font>
						</a>
						</li>
						<li><a data-edit="fontSize 3"><font size="3">Normal</font>
						</a>
						</li>
						<li><a data-edit="fontSize 1"><font size="1">Small</font>
						</a>
						</li>
					</ul>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="bold"
						title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i>
					</a> <a class="btn btn-default" data-edit="italic"
						title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i>
					</a> <a class="btn btn-default" data-edit="strikethrough"
						title="Strikethrough"><i class="icon-strikethrough"></i>
					</a> <a class="btn btn-default" data-edit="underline"
						title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i>
					</a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="insertunorderedlist"
						title="Bullet list"><i class="icon-list-ul"></i>
					</a> <a class="btn btn-default" data-edit="insertorderedlist"
						title="Number list"><i class="icon-list-ol"></i>
					</a> <a class="btn btn-default" data-edit="outdent"
						title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i>
					</a> <a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><i
						class="icon-indent-right"></i>
					</a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="justifyleft"
						title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i>
					</a> <a class="btn btn-default" data-edit="justifycenter"
						title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i>
					</a> <a class="btn btn-default" data-edit="justifyright"
						title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i>
					</a> <a class="btn btn-default" data-edit="justifyfull"
						title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i>
					</a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown"
						title="Hyperlink"><i class="icon-link"></i>
					</a>
					<div class="dropdown-menu input-append">
						<input class="span2" placeholder="URL" type="text"
							data-edit="createLink" />
						<button class="btn" type="button">Add</button>
					</div>
				</div>

				<div class="btn-group">
					<a class="btn btn-default" data-edit="unlink"
						title="Remove Hyperlink"><i class="icon-cut"></i>
					</a> <a class="btn btn-default"
						title="Insert picture (or just drag & drop)" id="pictureBtn">
						<i class="icon-picture"></i> <input type="file"
						data-role="magic-overlay" data-target="#pictureBtn"
						data-edit="insertImage" /> </a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="undo"
						title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i>
					</a> <a class="btn btn-default" data-edit="redo"
						title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i>
					</a>
				</div>
				<input class="pull-right" type="text" data-edit="inserttext"
					id="voiceBtn" x-webkit-speech="" />
			</div>

			<div id="editor" class="lead" placeholder="Edit..."></div>
		</div>';
	}
}

/**
 * Este método carga los elementos necesarios para el funcionamiento del richbox
 *
 * @access	public
 * @param	bool 		= default: bootstrap load, false: bootstrap unload
 */
if ( ! function_exists('sources'))
{
	function sources($boostrap = true)
	{
		// obtenemos instancia global del core CodeIgniter
		$CI =& get_instance();
		// obtenemos la base url establecida en la configuración
		$base_url = $CI->config->item('base_url');
		// creamos los stilos
		$styles = "";
		if(!$boostrap)
		{
			$styles .= "
	<link rel='stylesheet'
		href='http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css' />
	<script
		src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
	<script src='http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script>";
		}
		$styles .= "
	<link
		href='http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css'
		rel='stylesheet' />
	<link href='" . $base_url . "richtext/external/google-code-prettify/prettify.css' rel='stylesheet'/>
	<script src='" . $base_url . "richtext/external/jquery.hotkeys.js'></script>
	<script src='" . $base_url . "richtext/external/google-code-prettify/prettify.js'></script>
	<link href='" . $base_url . "richtext/css/style.css' rel='stylesheet' />
	<script src='" . $base_url . "richtext/src/bootstrap-wysiwyg.js'></script>";
		
		return $styles;
	}
}

/* End of file array_helper.php */
/* Location: ./application/helpers/richbox_helper.php */