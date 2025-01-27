<?php

namespace App\Model;

class Restaurant
{
// utilisé par classement et la map
// fonction pour récuperer le nom, la note globale, la latitude et la longitude d'un resto
// fonction pour fetch "certaines" données d'un resto crous en utilsant l'api crous
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function reload()
    {
        $urls = [
            "http://webservices-v2.crous-mobile.fr/feed/aix.marseille/externe/crous-aix.marseille.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/amiens/externe/crous-amiens.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/antilles.guyane/externe/crous-antilles.guyane.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/bfc/externe/crous-bfc.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/bordeaux/externe/crous-bordeaux.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/clermont.ferrand/externe/crous-clermont.ferrand.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/corte/externe/crous-corte.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/creteil/externe/crous-creteil.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/grenoble/externe/crous-grenoble.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/lille/externe/crous-lille.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/limoges/externe/crous-limoges.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/lyon/externe/crous-lyon.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/montpellier/externe/crous-montpellier.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/nancy.metz/externe/crous-nancy.metz.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/nantes/externe/crous-nantes.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/nice/externe/crous-nice.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/normandie/externe/crous-normandie.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/orleans.tours/externe/crous-orleans.tours.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/paris/externe/crous-paris.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/poitiers/externe/crous-poitiers.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/reims/externe/crous-reims.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/rennes/externe/crous-rennes.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/reunion/externe/crous-reunion.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/strasbourg/externe/crous-strasbourg.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/toulouse/externe/crous-toulouse.min.json",
            "http://webservices-v2.crous-mobile.fr/feed/versailles/externe/crous-versailles.min.json"
        ];

        $stmt = $this->pdo->prepare("INSERT INTO restaurant(idRestaurant, nom, adresse, latitude, longitude, urlApi) VALUES (?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE nom = ?, adresse = ?, latitude = ?, longitude = ?, urlApi = ?");
        foreach ($urls as $url) {
            $response = file_get_contents($url);
            $response = preg_replace('/[\x00-\x1F\x7F]/', '', $response);
            if ($response !== false) {
                $jsonData = json_decode($response);

                foreach ($jsonData->restaurants as $json) {
                    $stmt->execute([$json->id, $json->title, $json->adresse, $json->lat, $json->lon, $url, $json->title, $json->adresse, $json->lat, $json->lon, $url]);
                }
            }
        }
    }

    function getRestaurants() {
        $stmt = $this->pdo->prepare("SELECT * FROM restaurant");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getMenu($id) {
        $stmt = $this->pdo->prepare("SELECT urlApi FROM restaurant WHERE idRestaurant = ?");
        $stmt->execute([$id]);
        $url = $stmt->fetch()['urlApi'];

        $response = file_get_contents($url);
        $response = preg_replace('/[\x00-\x1F\x7F]/', '', $response);

        if ($response !== false) {
            $jsonData = json_decode($response);

            foreach ($jsonData->restaurants as $restaurant) {
                if ($restaurant->id == $id) {
                    return $restaurant->menus;
                }
            }
        }
        return [];
    }

    function getRestaurantDetails($id) {
        $stmt = $this->pdo->prepare("SELECT urlApi FROM restaurant WHERE idRestaurant = ?");
        $stmt->execute([$id]);
        $url = $stmt->fetch()['urlApi'];

        $response = file_get_contents($url);
        $response = preg_replace('/[\x00-\x1F\x7F]/', '', $response);

        if ($response !== false) {
            $jsonData = json_decode($response);

            foreach ($jsonData->restaurants as $restaurant) {
                if ($restaurant->id === $id) {
                    return [
                        'title' => $restaurant->title,
                        'area' => $restaurant->area,
                        'address' => $restaurant->adresse,
                        'type' => $restaurant->type,
                        'accessibility' => $restaurant->accessibility,
                        'wifi' => $restaurant->wifi,
                        'description' => $restaurant->description,
                        'access' => $restaurant->access,
                        'operationalhours' => $restaurant->operationalhours,
                        'contact' => [
                            'phone' => $restaurant->contact->tel, // Téléphone
                            'email' => $restaurant->contact->email // Email
                        ],
                        'payment' => array_map(function($payment) {
                            return $payment->name; // Liste des moyens de paiement
                        }, $restaurant->payment),
                        'photo' => [
                            'src' => $restaurant->photo->src, // Lien vers la photo
                            'alt' => $restaurant->photo->alt  // Texte alternatif de la photo
                        ]
                    ];
                }
            }
        }


        return [];
    }



}