<?php
include('simple_html_dom.php');
date_default_timezone_set('Asia/Bangkok');

if((isset($_GET['courier']) && !empty($_GET['courier'])) && (isset($_GET['resi']) && !empty($_GET['resi']))) {
    $courier = $_GET["courier"];
    $resi = $_GET["resi"];

    $cache = 'cache/'. $resi;
    if (file_exists($cache) && (filemtime($cache) > (time() - 3600 ))) {
      $data = file_get_contents($cache);

      echo $data;

    } else {

      $url = "https://track.aftership.com/$courier/$resi";

      $html = file_get_html($url);
      $courier_name = $html->find('h2', 0)->plaintext;
      $list = $html->find('.checkpoint');

      // time out handler
      if (empty($html)) {
        $data['status'] = 500;
        $data['info'] = "request time out";
        $data = json_encode($data);
        echo $data; 
      }

      // check tracking exist
      if($list) {
        $data = array();
        $track = array();

        foreach($list as $e) {
          $date = $e->find(".checkpoint__time strong", 0)->plaintext;
          $time = $e->find(".checkpoint__time .hint", 0)->plaintext;
          $location = $e->find(".checkpoint__content strong", 0)->plaintext;
          $loc = substr($location, 0, - strlen($courier_name) -1);
          $country = $e->find(".checkpoint__content .hint", 0)->plaintext;
          $stat = $e->find(".checkpoint__icon", 0)->getAttribute('class');
          $status = str_replace('checkpoint__icon ', '', $stat);
          
          $track[] = array(
            'date' => $date,
            'time' => $time,
            'status' => $status,
            'location' => $loc,
            'country' => $country
          );
        }

        $data['status'] = 200;
        $data['courier'] = strtoupper($courier_name);
        $data['resi'] = $resi;
        $data['track'] = $track;
        $data = json_encode($data);

        if (!is_dir('cache/')) {
          mkdir('cache/', 0777, true);
        }

        file_put_contents($cache, $data, LOCK_EX);
        echo $data;
        
      } else {
        $data['status'] = 404;
        $data['info'] = "data not found";
        $data = json_encode($data);
        echo $data;
      }

      $html->clear();
      unset($html);
   }
} else {
  $data['status'] = 500;
  $data['info'] = "parameter not complate";
  $data = json_encode($data);
  echo $data;
}
?>