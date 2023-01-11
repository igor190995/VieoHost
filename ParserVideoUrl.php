<?php

class ParserVideoUrl
{

    private $parsedUrl = [];
    private $error = '';
    private $url = '';
    private const associatedVideoHostNames = [
        'youtu' => 'Ютьюб',
        'vimeo' => 'Вимео'
    ];

    function __construct($url)
    {
        $this->setUrl($url);
        $this->setParsedUrl();
        $this->setErrorUrl();

        file_put_contents("log.txt", print_r($this, true), FILE_APPEND);
    }

    public function getHtmlFrame()
    {
        if($this->error === ''){
            return '<iframe width="480" height="270" src="' . $this->url . '" frameborder="0" 
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen="">
                </iframe>';
        }
        else{
            return 'html код не удалось построить из-за некорректности введенного html';
        }
    }

    public function getError()
    {
        return $this->error;
    }

    private function setParsedUrl() {
        $this->parsedUrl = parse_url($this->url);
    }

    private function setErrorUrl(){
        if ($this->parsedUrl['host'] == false) {
            $this->error = 'Введен некорректный url';
        }
    }

    private function setUrl($url){
        $this->url = $url;
    }

    public function getNameHost(){
        foreach(self::associatedVideoHostNames as $hostKey => $hostName){
            if(stripos($this->parsedUrl['host'], $hostKey, 0) !== false){
                return $hostName;
            }
        }

        return 'имя хостинга не определено';
    }

    public function getVideoId(){
        if(trim($this->parsedUrl['path']) === '/watch' && substr(trim($this->parsedUrl['query']), 0, 2) === "v="){
            return substr($this->parsedUrl['query'], 2);
        }
        return substr($this->parsedUrl['path'], 1);
    }
}
