<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\City;

class CityFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cities = ["Safi","Ouled Teima","Sidi Yahia al Gharb","Sedala","Sefrú","Toumiat Zaïo","Khouribga","Louis Gentil","Asilah","Beni Mellal","Tan-Tan","El Hajeb","El Jadida","Uazán","Mechra-bel-Kairi","Taza","Garsif","Kasba bou Znika","Nador","Ouarzazate","Aïn Zorèn","Settat","Tirhanimîne","El Ayba Tahalla","Larache","Tiznit","Ifni","El Ksar El Kebir","Azrou","Ahfir","Kimisset","Midelt","Boujniba","Goulimine","Skhirate"];
        
        foreach($cities as $value){
            $city = new City();
            $city->setName($value);
            $manager->persist($city);
        }

        $manager->flush();
    }
}
