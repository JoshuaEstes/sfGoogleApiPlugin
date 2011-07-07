<?php

/**
 *
 */
class sfGoogleApiPlacesDetails
{

  protected $output = 'json';
  protected $reference;
  protected $language = 'en';
  protected $sensor = 'false';
  protected $key;
  protected $data;
  protected $isLoaded = false;

  public function __construct($reference, $key=null)
  {
    $this->reference = $reference;
    if (is_null($key))
    {
      $key = sfConfig::get('app_sf_google_api_plugin_key');
    }
    $this->key = $key;
  }

  public function load(array $parameters = array())
  {
    $parameters = array_merge(array(
        'reference' => $this->reference,
        'sensor' => $this->sensor,
        'key' => $this->key,
        'language' => $this->language,
        ), $parameters);

    $uri = 'https://maps.googleapis.com/maps/api/place/details/' . $this->output . '?' . preg_replace(array('/\%2C/'), array(','), http_build_query($parameters));

    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = json_decode($output);
    $this->data = $output->result;

    $this->isLoaded = true;

    return $this;
  }

  public function getData()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data;
  }

  public function getName()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->name;
  }

  public function getVicinity()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->vicinity;
  }

  public function getTypes()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->types;
  }

  public function getFormattedPhoneNumber()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->formatted_phone_number;
  }

  public function getFormattedAddress()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->formatted_address;
  }

  public function getAddressComponents()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->address_components;
  }

  public function getGeometry()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->geometry;
  }

  public function getLatitude()
  {
    return $this->getGeometry()->location->lat;
  }

  public function getLongitude()
  {
    return $this->getGeometry()->location->lng;
  }

  public function getRating()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->rating;
  }

  public function getUrl()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->url;
  }

  public function getId()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->id;
  }

  public function getReference()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->reference;
  }

  public function getIcon()
  {
    if (!$this->isLoaded)
      $this->load();

    return $this->data->icon;
  }

}