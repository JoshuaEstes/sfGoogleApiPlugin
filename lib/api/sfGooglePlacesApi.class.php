<?php

/**
 *
 */
class sfGooglePlacesApi
{

  protected $output = 'json';
  // meters
  protected $radius = 1000;
  protected $types;
  protected $language = 'en';
  protected $name;
  protected $sensor = 'false';
  protected $key;
  protected $latitude;
  protected $longitude;

  public function __construct($key=null)
  {
    if (is_null($key))
    {
      $key = sfConfig::get('app_sf_google_api_plugin_key');
    }

    $this->key = $key;
  }

  public static function getLocationTypesArray()
  {
    return array(
//      'accounting',
//      'airport',
//      'amusement_park',
//      'aquarium',
//      'art_gallery',
//      'atm',
      'bakery' => 'Bakery',
//      'bank',
//      'bar',
//      'beauty_salon',
//      'bicycle_store',
//      'book_store',
//      'bowling_alley',
//      'bus_station',
//      'cafe',
//      'campground',
//      'car_dealer',
//      'car_rental',
//      'car_repair',
//      'car_wash',
//      'casino',
//      'cemetery',
      'church' => 'Church',
//      'city_hall',
//      'clothing_store',
//      'convenience_store',
//      'courthouse',
//      'dentist',
//      'department_store',
//      'doctor',
//      'electrician',
//      'electronics_store',
//      'embassy',
//      'establishment' => 'Establishment',
//      'finance',
//      'fire_station',
//      'florist',
//      'food',
//      'funeral_home',
//      'furniture_store',
//      'gas_station',
//      'general_contractor',
//      'geocode',
//      'grocery_or_supermarket',
      'gym' => 'Gym',
//      'hair_care',
//      'hardware_store',
//      'health',
//      'hindu_temple',
//      'home_goods_store',
//      'hospital',
//      'insurance_agency',
//      'jewelry_store',
//      'laundry',
//      'lawyer',
//      'library',
//      'liquor_store',
//      'local_government_office',
//      'locksmith',
//      'lodging',
//      'meal_delivery',
//      'meal_takeaway',
//      'mosque',
//      'movie_rental',
//      'movie_theater',
//      'moving_company',
//      'museum',
//      'night_club',
//      'painter',
//      'park',
//      'parking',
//      'pet_store',
//      'pharmacy',
//      'physiotherapist',
//      'place_of_worship',
//      'plumber',
//      'police',
//      'post_office',
//      'real_estate_agency',
      'restaurant' => 'Restaurant',
//      'roofing_contractor',
//      'rv_park',
//      'school',
//      'shoe_store',
      'shopping_mall' => 'Shopping Mall',
      'spa' => 'Spa',
//      'stadium',
//      'storage',
      'store' => 'Store',
//      'subway_station',
//      'synagogue',
//      'taxi_stand',
//      'train_station',
//      'travel_agency',
//      'university',
//      'veterinary_care',
      'zoo' => 'Zoo',
    );
  }

  public function getLocation()
  {
    return $this->latitude . ',' . $this->longitude;
  }

  public function setLatitude($latitude)
  {
    $this->latitude = $latitude;
    return $this;
  }

  public function setLongitude($longitude)
  {
    $this->longitude = $longitude;
    return $this;
  }

  public function search(array $parameters = array())
  {
    $parameters = array_merge(array(
        'location' => $this->getLocation(),
        'radius' => $this->radius,
        'sensor' => $this->sensor,
        'key' => $this->key
        ), $parameters);

    $uri = 'https://maps.googleapis.com/maps/api/place/search/' . $this->output . '?' . preg_replace(array('/\%2C/'), array(','), http_build_query($parameters));

//    var_dump($uri);
//    var_dump($parameters);
//    die();

    $ch = curl_init($uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $output = json_decode($output);
    $places = new sfGooglePlaces($output->results);
    return $places;
  }

  protected function build_query($parameters)
  {
    $query_string = '';
    foreach ($parameters as $k => $v)
    {
      $query_string .= $k . '=' . $v;
    }
    return $query_string;
  }

}