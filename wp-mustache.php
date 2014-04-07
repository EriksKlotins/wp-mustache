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



class Mustache
{
	
	private $templateDir = null;
	private $cacheDir = null;

	public function __construct($templateDir = null, $cacheDir = null)
	{
		$this->templateDir = $templateDir ? $templateDir : get_template_directory().'/templates';
		$this->cacheDir = $cacheDir ? $cacheDir : get_template_directory().'/cache';
		Mustache_Autoloader::register();
	}



	// public static function make($template, $data = array())
	// {
	// 	if (!is_array($template)) $template = array($template);

	// 	for($i=0;$i<count($template);$i++)
	// 	{
	// 		$parts = explode('/',$template[$i]);
	// 		$templateDir = get_template_directory().'/templates';
	// 		for($j=0;$j<count($parts)-1;$j++)
	// 		{
	// 			$templateDir .= '/'.$parts[$j];
	// 		}
	// 		//var_dump($templateDir);
	// 		$m = new Mustache_Engine(array(
	// 			'loader' => new \Mustache_Loader_FilesystemLoader($templateDir,array('extension'=>'mustache')),
	// 			'cache' =>	$this->cacheDir ? $this->cacheDir : get_template_directory().'/cache'
	// 		));
	// 		echo $m ->render($parts[count($parts)-1],$data);
	// 		// var_dump($parts);
	// 	}
	// }


	/**
	 * Fills provided template with data and outputs it
	 * @param  mixed $templateName template file name or array with names
	 * @param  object $data         data to be rendered
	 * @return string               Rendered template
	 */
	public function render($templateName, $data)
	{
		$m = new Mustache_Engine(array(
			'loader' => new \Mustache_Loader_FilesystemLoader($this->templateDir,array('extension'=>'mustache')),
			'cache' =>$this->cacheDir
		));
		if (!is_array($templateName)) $templateName = [$templateName];

		$result = '';
		if (is_array($templateName))
		{
			for($i=0;$i<count($templateName);$i++)
			{
				$result .= $m ->render($templateName[$i],$data);
			}
		}
		return $result;
	}



}