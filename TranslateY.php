<?php

class TranslateY {

    private $api_key;
    private $detect_url = 'https://translate.yandex.net/api/v1.5/tr.json/detect';
    private $translate_url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    public function translate($text, $to_lang, $from_lang = '')
    {
        $key = $this->api_key;
        //$text = urlencode($text);
        if (empty($from_lang) ) {
            $from_lang = $this->detectLang($text);
        }
        $lang = $from_lang . '-' . $to_lang;
        $url = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=".$key."&text=".$text."&lang=".$lang;
        $result = $this->query($url);
        $result = json_decode($result, true);
        return $result['text'][0];
    }

    public function detectLang($text)
    {
        $key = $this->api_key;
        $url = "https://translate.yandex.net/api/v1.5/tr.json/detect?key=$key&text=$text";
        $result = $this->query($url);
        $result = json_decode($result, true);
        return $result['lang'];
    }

    private function query($url)
    {
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
            $out = curl_exec($curl);
            curl_close($curl);
        }
        return $out;
    }

}

