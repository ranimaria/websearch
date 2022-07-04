<?php 

namespace Rani\Searchengine;
use Exception;
use simple_html_dom;

include('lib/simple_html_dom.php');

class SearchEngine{


  public function setEngine($searchEngine){
    try{
    if ($searchEngine !== 'google.ae' && $searchEngine !== 'google.com') {
      throw new Exception('Search engine should be either google.ae or google.com');
    }
    $this->searchEngine = $searchEngine;
    return $this;
  }catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
   
  }
  
  
  }




public function searchdata($keywords)
{
    
  try{
    $resultArray = array();
    $html = array();
    for ($i = 0; $i < count($keywords); $i++) {

    $encodedData = urlencode($keywords[$i]);
    $html[$i] = file_get_html('http://www.'.$this->searchEngine.'/search?hl=en&output=search&q='.$encodedData.'&start=0&num=50');
  
   foreach($html[$i]->find('div.Gx5Zad.fP1Qef') as $rank => $element) { 
    
    
        $adResult  =  $element->find('span.CnP9N.U3A9Ac.qV8iec', 0);
        $promoted = 0;

        if ($adResult) {
          $promoted = $element->find('span.CnP9N.U3A9Ac.qV8iec', 0)->plaintext == 'Ad' ? 1 : 0;
        }
        

        if (!$promoted) {
            $title = html_entity_decode($element->find('div.BNeawe.vvjwJb.AP7Wnd', 0)->plaintext);
            $url = parseUrl($element->find('div.BNeawe.UPmit.AP7Wnd', 0)->plaintext);
            $description = html_entity_decode($element->find('div.BNeawe.s3v9rd.AP7Wnd', 0)->plaintext);
            $result = array('keyword' => $keywords[$i],'ranking' => $rank, 'url' => $url,'title' => $title,  'description' => $description, 'promoted' => $promoted);
            array_push($resultArray, $result);
          } else {
            $title = html_entity_decode($element->find('div.CCgQ5.MUxGbd.v0nnCb.aLF0Z.OSrXXb>span', 0)->plaintext);
            $url = parseUrl($element->find('span.qzEoUe', 0)->plaintext);
            $description = html_entity_decode($element->find('div.MUxGbd.yDYNvb.lyLwlc>div', 0)->plaintext);
            $result = array('keyword' => $keywords[$i],'ranking' => $rank, 'url' => $url,'title' => $title,  'description' => $description, 'promoted' => $promoted);
            array_push($resultArray, $result);
          } 
      }
        
} 

return $resultArray;
}catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
   
  }
}
}


function parseUrl($url)
{
  $url = str_replace('&#8250;', '/', $url);
  $url = html_entity_decode($url);
  $url = preg_replace('/\s/', '', $url);
  return $url;
}

?>