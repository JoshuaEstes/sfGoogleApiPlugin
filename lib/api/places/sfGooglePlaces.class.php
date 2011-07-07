<?php

/**
 *
 */
class sfGooglePlaces implements Iterator, Countable
{

  protected $places;
  protected $key;

  public function __construct($results=null)
  {
    if (!is_null($results))
    {
      foreach ($results as $place)
      {
        $this->addPlace($place);
      }
    }
  }

  public function addPlace($place)
  {
    $this->places[] = new sfGooglePlace($place);
  }

  public function current()
  {
    return $this->places[$this->key];
  }

  public function next()
  {
    $this->key++;
  }

  public function key()
  {
    return $this->key;
  }

  public function valid()
  {
    return $this->count() > $this->key() ? true : false;
  }

  public function rewind()
  {
    $this->key = 0;
  }

  public function count()
  {
    return count($this->places);
  }

}