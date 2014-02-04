<?php
/*
Plugin Name: WP Moustache
Plugin URI: http://localhost
Description: Adds Moustache templates to Wordpress
Version: 1.0
Author: E.Klotins
Author URI: #
License: GPLv2 or later
*/

require dirname(__FILE__).'/Mustache/Autoloader.php';
class Moustache
{
	
	private $templateDir = null;
	private $cacheDir = null;

	public function __construct($templateDir = null, $cacheDir = null)
	{
		$this->templateDir = $templateDir ? $templateDir : get_template_directory().'/templates';
		$this->cacheDir = $cacheDir ? $cacheDir : get_template_directory().'/cache/haml';
	}


	/**
	 * Fills provided template with data and outputs it
	 * @param  string $templateName template file name
	 * @param  object $data         data to be rendered
	 * @return string               Rendered template
	 */
	public function render($templateName, $data)
	{
		$m = new Mustache_Engine(array(
			'loader' => new \Mustache_Loader_FilesystemLoader($this->templateDir,array('extension'=>'moustache')),
			'cache' =>$this->cacheDir
		));

		$result = '';
		if (is_array($templateName))
		{
			for($i=0;$i<count($templateName);$i++)
			{
				$result .= $m ->render($templateName[$i],$data);
			}
		}
		else
		{
			$result .= $m ->render($templateName,$data);
		}
		

		return $result;
	}


}