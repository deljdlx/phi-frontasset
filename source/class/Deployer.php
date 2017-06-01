<?php

namespace Phi\FrontAsset;


class Deployer
{


	protected $path;
	protected $url;


	public function __construct($path, $url) {
		$this->path=$path;
		$this->url=$url;
	}


	public function deploy(Asset $asset) {

		if($asset->isLocal()) {
			$fileName=basename($asset->getURI());
			$resourcePath=$asset->getPath();
			copy(
				$resourcePath,
				$this->path.'/'.$fileName
			);
		}



		elseif($asset->isString()) {
			$content=$asset->getContent();

			if($asset instanceof \Phi\Asset\Javascript) {
				$fileName=md5($content).'.js';
			}
			elseif($asset instanceof \Phi\Asset\CSS) {
				$fileName=md5($content).'.css';
			}

			file_put_contents($this->path.'/'.$fileName, $content);
		}

		return $this->url.'/'.$fileName;

	}





}



