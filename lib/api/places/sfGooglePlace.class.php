<?php

/**
 *
 */
class sfGooglePlace
{
  protected $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function getName()
  {
    return $this->data->name;
  }

  public function getVicinity()
  {
    return $this->data->vicinity;
  }

  public function getTypes()
  {
    return $this->data->types;
  }

  public function getGeometry()
  {
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

  public function getViewPort()
  {
    return $this->getGeometry()->viewport;
  }

  public function getIcon()
  {
    return $this->data->icon;
  }

  public function getReference()
  {
    return $this->data->reference;
  }

  public function getId()
  {
    return $this->data->id;
  }

}