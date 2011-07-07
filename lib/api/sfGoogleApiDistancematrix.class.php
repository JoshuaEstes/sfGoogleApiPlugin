<?php

/**
 *
 */
class sfGoogleApiDistancematrix
{

  protected $output = 'json';
  protected $originLatitude;
  protected $originLongitude;
  protected $destinationLatitude;
  protected $destinationLongitude;
  protected $mode = 'walking';
  protected $sensor = 'false';

  public function setOriginLatitude($latitude)
  {
    $this->originLatitude = $latitude;
    return $this;
  }

  public function setOriginLongitude($longitude)
  {
    $this->originLongitude = $longitude;
    return $this;
  }

  public function setDestinationLatitude($latitude)
  {
    $this->destinationLatitude = $latitude;
    return $this;
  }

  public function setDestinationLongitude($longitude)
  {
    $this->destinationLongitude = $longitude;
    return $this;
  }

  public function calculateDistance(array $parameters = array())
  {

    $parameters = array_merge(array(
//      'reference' => $this->reference,
      'sensor' => $this->sensor,
//      'key' => $this->key,
//      'language' => $this->language,
      'origins' => $this->originLatitude.','.$this->originLongitude,
      'destinations' => $this->destinationLatitude.','.$this->destinationLongitude,
    ), $parameters);

    $uri = 'https://maps.googleapis.com/maps/api/distancematrix/'.$this->output.'?'.preg_replace(array('/\%2C/'), array(','), http_build_query($parameters));

    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $this->data = json_decode($output);

//    var_dump($this->data->rows[0]->elements[0]);
//    die();

    return $this;
  }

  public function getDistance()
  {
    return $this->data->rows[0]->elements[0]->distance->text;
  }

}