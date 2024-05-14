<?php
require_once '../vendor/autoload.php';
require_once 'config/db.php';

function strtolower_turkish($text)
{
    $text = trim($text);
    $search = ['Ç', 'Ğ', 'I', 'İ', 'Ö', 'Ş', 'Ü'];
    $replace = ['ç', 'ğ', 'ı', 'i', 'ö', 'ş', 'ü'];
    $text = str_replace($search, $replace, $text);
    return strtolower($text);
}

function ucfirst_turkish($text)
{
    $text = trim($text);
    $text_length = strlen($text);
    $first_letter = mb_substr($text, 0, 1, 'UTF-8');
    if ($first_letter == 'Ç' || $first_letter == 'ç') {
        $first_letter = 'Ç';
    } elseif ($first_letter == 'Ğ' || $first_letter == 'ğ') {
        $first_letter = 'Ğ';
    } elseif ($first_letter == 'I' || $first_letter == 'ı') {
        $first_letter = 'I';
    } elseif ($first_letter == 'İ' || $first_letter == 'i') {
        $first_letter = 'İ';
    } elseif ($first_letter == 'Ö' || $first_letter == 'ö') {
        $first_letter = 'Ö';
    } elseif ($first_letter == 'Ş' || $first_letter == 'ş') {
        $first_letter = 'Ş';
    } elseif ($first_letter == 'Ü' || $first_letter == 'ü') {
        $first_letter = 'Ü';
    } else {
        $first_letter = strtoupper($first_letter);
    }
    $other_letters = mb_substr($text, 1, $text_length, 'UTF-8');
    return $first_letter.strtolower_turkish($other_letters);
}

function ucwords_turkish($text)
{
    $result = '';
    $words = explode(' ', $text);
    foreach ($words as $word) {
        $result .= ucfirst_turkish($word).' ';
    }
    return trim(str_replace('  ', ' ', $result));
}

if (!empty($_POST['get_city_list'])) {
    $response = new \App\Library\Response();
    $search = isset($_POST['q']) ? trim($_POST['q']) : '';
    try {
        $query_city = "SELECT id, name, plate_code, towns, lat, lon, ST_AsGeoJSON(`polygons`) as polygons, boundingbox FROM cities";
        if (!empty($search)) {
            $query_city .= " WHERE name LIKE '%".$search."%' OR plate_code LIKE '%".$search."%'";
        }
        $query_city .= " ORDER BY ABS(plate_code)";
        $query_city_total = $db->query($query_city, PDO::FETCH_ASSOC)->rowCount();
        $response->appendData($query_city_total, 'total');
        $limit = 41;
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $response->appendData($limit, 'limit');
        $response->appendData($page, 'page');
        if (empty($page) || $page <= 1) {
            $query_city .= " LIMIT ".$limit;
        } else {
            $query_city .= " LIMIT ".(($limit * $page) - $limit).", ".$limit;
        }
        $query_city_list = $db->query($query_city, PDO::FETCH_ASSOC);
        if ($query_city_list->rowCount() > 0) {
            $city_list = $query_city_list->fetchAll(PDO::FETCH_ASSOC);
            $items = array();
            foreach ($city_list as $city) {
                if (!empty($city['towns'])) {
                    $city['towns'] = json_decode($city['towns'], true);
                }
                if (!empty($city['polygons'])) {
                    $city['polygons'] = json_decode($city['polygons'], true);
                }
                if (!empty($city['boundingbox'])) {
                    $city['boundingbox'] = json_decode($city['boundingbox'], true);
                }
                $items[] = $city;
            }
            $response->appendData($items, 'items');
        }
        $response->setStatus(true);
        $response->setStatusCode(200);
    } catch (\Exception $e) {
        $response->setStatusCode($e->getCode());
        $response->setStatusText($e->getMessage());
        $response->setMessage('An error occurred while retrieving the city list.');
    }
    echo $response->toJson();
    return true;
}
if (!empty($_POST['get_town_list'])) {
    $response = new \App\Library\Response();
    $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : null;
    $search = isset($_POST['q']) ? trim($_POST['q']) : '';
    try {
        $query_town = "SELECT id, city_id, name, districts FROM towns";
        if (!empty($city_id)) {
            $query_town .= " WHERE city_id='".$city_id."'";
        }
        if (!empty($search)) {
            if (!empty($city_id)) {
                $query_town .= " AND (name LIKE '%".$search."%' OR districts LIKE '%".$search."%') ";
            } else {
                $query_town .= " WHERE name LIKE '%".$search."%' OR districts LIKE '%".$search."%'";
            }
        }
        $query_town .= " ORDER BY name ASC";
        $query_town_total = $db->query($query_town, PDO::FETCH_ASSOC)->rowCount();
        $response->appendData($query_town_total, 'total');
        $limit = 41;
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $response->appendData($limit, 'limit');
        $response->appendData($page, 'page');
        if (empty($page) || $page <= 1) {
            $query_town .= " LIMIT ".$limit;
        } else {
            $query_town .= " LIMIT ".(($limit * $page) - $limit).", ".$limit;
        }
        $query_town_list = $db->query($query_town, PDO::FETCH_ASSOC);
        if ($query_town_list->rowCount() > 0) {
            $town_list = $query_town_list->fetchAll(PDO::FETCH_ASSOC);
            $items = array();
            foreach ($town_list as $town) {
                if (!empty($town['districts'])) {
                    $town['districts'] = json_decode($town['districts'], true);
                }
                $items[] = $town;
            }
            $response->appendData($items, 'items');
        }
        $response->setStatus(true);
        $response->setStatusCode(200);
    } catch (\Exception $e) {
        $response->setStatusCode($e->getCode());
        $response->setStatusText($e->getMessage());
        $response->setMessage('An error occurred while retrieving the town list.');
    }
    echo $response->toJson();
    return true;
}
if (!empty($_POST['get_district_list'])) {
    $response = new \App\Library\Response();
    $city_id = isset($_POST['city_id']) ? intval($_POST['city_id']) : null;
    $town_id = isset($_POST['town_id']) ? intval($_POST['town_id']) : null;
    $search = isset($_POST['q']) ? trim($_POST['q']) : '';
    try {
        $query_district = "SELECT id, city_id, town_id, name, zip_code, neighbourhoods FROM districts";
        if (!empty($city_id)) {
            $query_district .= " WHERE city_id='".$city_id."'";
        }
        if (!empty($town_id)) {
            if (!empty($city_id)) {
                $query_district .= " AND ";
            } else {
                $query_district .= " WHERE ";
            }
            $query_district .= " town_id='".$town_id."'";
        }
        if (!empty($search)) {
            if (!empty($city_id) || !empty($town_id)) {
                $query_district .= " AND (name LIKE '%".$search."%' OR zip_code LIKE '%".$search."%' OR neighbourhoods LIKE '%".$search."%')";
            } else {
                $query_district .= " WHERE name LIKE '%".$search."%' OR zip_code LIKE '%".$search."%' OR neighbourhoods LIKE '%".$search."%'";
            }
        }
        $query_district .= " ORDER BY name ASC";
        $query_district_total = $db->query($query_district, PDO::FETCH_ASSOC)->rowCount();
        $response->appendData($query_district_total, 'total');
        $limit = 41;
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $response->appendData($limit, 'limit');
        $response->appendData($page, 'page');
        if (empty($page) || $page <= 1) {
            $query_district .= " LIMIT ".$limit;
        } else {
            $query_district .= " LIMIT ".(($limit * $page) - $limit).", ".$limit;
        }
        $query_district_list = $db->query($query_district, PDO::FETCH_ASSOC);
        if ($query_district_list->rowCount() > 0) {
            $town_list = $query_district_list->fetchAll(PDO::FETCH_ASSOC);
            $items = array();
            foreach ($town_list as $town) {
                if (!empty($town['neighbourhoods'])) {
                    $town['neighbourhoods'] = json_decode($town['neighbourhoods'], true);
                }
                $items[] = $town;
            }
            $response->appendData($items, 'items');
        }
        $response->setStatus(true);
        $response->setStatusCode(200);
    } catch (\Exception $e) {
        $response->setStatusCode($e->getCode());
        $response->setStatusText($e->getMessage());
        $response->setMessage('An error occurred while retrieving the district list.');
    }
    echo $response->toJson();
    return true;
}
if (!empty($_POST['get_neighbourhood_list'])) {
    $response = new \App\Library\Response();
    $city_id = isset($_POST['city_id']) ? intval($_POST['city_id']) : null;
    $town_id = isset($_POST['town_id']) ? intval($_POST['town_id']) : null;
    $district_id = isset($_POST['district_id']) ? intval($_POST['district_id']) : null;
    $search = isset($_POST['q']) ? trim($_POST['q']) : '';
    try {
        $query_neighbourhood = "SELECT id, city_id, town_id, district_id, name, zip_code, streets FROM neighbourhoods";
        if (!empty($city_id)) {
            $query_neighbourhood .= " WHERE city_id='".$city_id."'";
        }
        if (!empty($town_id)) {
            if (!empty($city_id)) {
                $query_neighbourhood .= " AND ";
            } else {
                $query_neighbourhood .= " WHERE ";
            }
            $query_neighbourhood .= " town_id='".$town_id."'";
        }
        if (!empty($district_id)) {
            if (!empty($city_id) || !empty($town_id)) {
                $query_neighbourhood .= " AND ";
            } else {
                $query_neighbourhood .= " WHERE ";
            }
            $query_neighbourhood .= " district_id='".$district_id."'";
        }
        if (!empty($search)) {
            if (!empty($city_id) || !empty($town_id) || !empty($district_id)) {
                $query_neighbourhood .= " AND (name LIKE '%".$search."%' OR zip_code LIKE '%".$search."%')";
            } else {
                $query_neighbourhood .= " WHERE name LIKE '%".$search."%' OR zip_code LIKE '%".$search."%'";
            }
        }
        $query_neighbourhood .= " ORDER BY name ASC";
        $query_neighbourhood_total = $db->query($query_neighbourhood, PDO::FETCH_ASSOC)->rowCount();
        $response->appendData($query_neighbourhood_total, 'total');
        $limit = 41;
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $response->appendData($limit, 'limit');
        $response->appendData($page, 'page');
        if (empty($page) || $page <= 1) {
            $query_neighbourhood .= " LIMIT ".$limit;
        } else {
            $query_neighbourhood .= " LIMIT ".(($limit * $page) - $limit).", ".$limit;
        }
        $query_neighbourhood_list = $db->query($query_neighbourhood, PDO::FETCH_ASSOC);
        if ($query_neighbourhood_list->rowCount() > 0) {
            $neighbourhood_list = $query_neighbourhood_list->fetchAll(PDO::FETCH_ASSOC);
            $items = array();
            foreach ($neighbourhood_list as $neighbourhood) {
                if (!empty($neighbourhood['streets'])) {
                    $neighbourhood['streets'] = json_decode($neighbourhood['streets'], true);
                }
                $items[] = $neighbourhood;
            }
            $response->appendData($items, 'items');
        }
        $response->setStatus(true);
        $response->setStatusCode(200);
    } catch (\Exception $e) {
        $response->setStatusCode($e->getCode());
        $response->setStatusText($e->getMessage());
        $response->setMessage('An error occurred while retrieving the neighbourhood list.');
    }
    echo $response->toJson();
    return true;
}
if (!empty($_POST['get_street_list'])) {
    $response = new \App\Library\Response();
    $city_id = isset($_POST['city_id']) ? intval($_POST['city_id']) : null;
    $town_id = isset($_POST['town_id']) ? intval($_POST['town_id']) : null;
    $district_id = isset($_POST['district_id']) ? intval($_POST['district_id']) : null;
    $neighbourhood_id = isset($_POST['neighbourhood_id']) ? intval($_POST['neighbourhood_id']) : null;
    $search = isset($_POST['q']) ? trim($_POST['q']) : '';
    try {
        $query_street = "SELECT id, name FROM streets";
        if (!empty($city_id)) {
            $query_street .= " WHERE city_id='".$city_id."'";
        }
        if (!empty($town_id)) {
            if (!empty($city_id)) {
                $query_street .= " AND ";
            } else {
                $query_street .= " WHERE ";
            }
            $query_street .= " town_id='".$town_id."'";
        }
        if (!empty($district_id)) {
            if (!empty($city_id) || !empty($town_id)) {
                $query_street .= " AND ";
            } else {
                $query_street .= " WHERE ";
            }
            $query_street .= " district_id='".$district_id."'";
        }
        if (!empty($neighbourhood_id)) {
            if (!empty($city_id) || !empty($town_id) || !empty($district_id)) {
                $query_street .= " AND ";
            } else {
                $query_street .= " WHERE ";
            }
            $query_street .= " neighbourhood_id='".$neighbourhood_id."'";
        }
        if (!empty($search)) {
            $search = ucfirst_turkish($search);
            if (!empty($city_id) || !empty($town_id) || !empty($district_id) || !empty($neighbourhood_id)) {
                $query_street .= " AND name LIKE '%".$search."%'";
            } else {
                $query_street .= " WHERE name LIKE '%".$search."%'";
            }
        }
        $query_street .= " ORDER BY name ASC";
        $query_street_total = $db->query($query_street, PDO::FETCH_ASSOC)->rowCount();
        $response->appendData($query_street_total, 'total');
        $limit = 41;
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $response->appendData($limit, 'limit');
        $response->appendData($page, 'page');
        if (empty($page) || $page <= 1) {
            $query_street .= " LIMIT ".$limit;
        } else {
            $query_street .= " LIMIT ".(($limit * $page) - $limit).", ".$limit;
        }
        $query_street_list = $db->query($query_street, PDO::FETCH_ASSOC);
        if ($query_street_list->rowCount() > 0) {
            $street_list = $query_street_list->fetchAll(PDO::FETCH_ASSOC);
            $response->appendData($street_list, 'items');
        }
        if (isset($_POST['zip_code'])) {
            $response->appendData($_POST['zip_code'], 'zip_code');
        }
        $response->setStatus(true);
        $response->setStatusCode(200);
    } catch (\Exception $e) {
        $response->setStatusCode($e->getCode());
        $response->setStatusText($e->getMessage());
        $response->setMessage('An error occurred while retrieving the street list.');
    }
    echo $response->toJson();
    return true;
}
