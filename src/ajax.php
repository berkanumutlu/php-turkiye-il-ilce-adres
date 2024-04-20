<?php
require_once '../vendor/autoload.php';
require_once 'config/db.php';

if (!empty($_POST['get_city_list'])) {
    $response = new \App\Library\Response();
    $search = isset($_POST['q']) ? trim($_POST['q']) : '';
    try {
        $query_city = "SELECT id, name, plate_code, towns FROM cities";
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
        $query_neighbourhood = "SELECT id, name, zip_code FROM neighbourhoods";
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
            $response->appendData($neighbourhood_list, 'items');
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
