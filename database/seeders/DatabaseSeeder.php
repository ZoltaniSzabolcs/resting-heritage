<?php

namespace Database\Seeders;

use App\Models\Cemetery;
use App\Models\Grave;
use App\Models\Person;
use App\Models\User;
use Clickbar\Magellan\Data\Geometries\LineString;
use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Data\Geometries\Polygon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $cemetery = Cemetery::create([
            'name' => 'Házsongárdi temető',
            'city' => 'Cluj-Napoca',
            'description' => 'A híres erdélyi temető, történelmi jelentőségű sírokkal.',
            'boundary' => Polygon::make(
                [LineString::make(
                    [Point::makeGeodetic(46.76572442352034, 23.59094724655162),
                        Point::makeGeodetic(46.76672883391196, 23.595499511842107),
                        Point::makeGeodetic(46.75869559282614, 23.598332438740496),
                        Point::makeGeodetic(46.757918554157165, 23.594579800777204),
                        Point::makeGeodetic(46.76572442352034, 23.59094724655162)]
                )], 4326),
            'entrance' => Point::makeGeodetic(46.76592006927427, 23.591395024490673),
            'center' => Point::makeGeodetic(46.76156691716381, 23.59350499181761),
        ]);

        $grave = Grave::create([
            'cemetery_id' => $cemetery->id,
            'name' => 'A-12',
            'location' => Point::makeGeodetic(46.76425200008415,23.593785439517113),
            'boundary' => Polygon::make(
                [LineString::make(
                    [
                        Point::makeGeodetic(46.76432954847704,23.59384842359027),
                        Point::makeGeodetic(46.764217818050284,23.593893237348972),
                        Point::makeGeodetic(46.76418186788495,23.593692686416354),
                        Point::makeGeodetic(46.76427904587814,23.593652008471658),
                        Point::makeGeodetic(46.76432954847704,23.59384842359027),
                    ]
                )],)
        ]);

        Person::create([
            'grave_id' => $grave->id,
            'first_name' => 'János',
            'last_name' => 'Apáczai Csere',
            'birth_date' => '1625-06-10',
            'death_date' => '1659-12-31',
            'birth_place' => 'Kolozsvár',
            'death_place' => 'Gyulafehérvár',
            'biography' => 'Magyar pedagógus, filozófus, az első magyar enciklopédia szerzője.',
            'occupation' => 'Teacher, Philosopher',
            'image_url' => 'https://example.com/images/apaczai.jpg',
        ]);

        $persons = [
            [
                'first_name' => 'János',
                'last_name' => 'Bolyai',
                'birth_date' => '1802-12-15',
                'death_date' => '1860-01-27',
                'birth_place' => 'Kolozsvár',
                'death_place' => 'Marosvásárhely',
                'biography' => 'Magyar matematikus, a nem-euklideszi geometria megalapítója.',
                'occupation' => 'Mathematician',
                'image_url' => 'https://example.com/images/bolyai.jpg',
            ],
            [
                'first_name' => 'Károly',
                'last_name' => 'Kós',
                'birth_date' => '1883-12-16',
                'death_date' => '1977-08-25',
                'birth_place' => 'Temesvár',
                'death_place' => 'Sztána',
                'biography' => 'Építész, író, politikus, az erdélyi magyar építészet megújítója.',
                'occupation' => 'Architect, Writer',
                'image_url' => 'https://example.com/images/koskaroly.jpg',
            ],
            [
                'first_name' => 'Albert',
                'last_name' => 'Szenczi Molnár',
                'birth_date' => '1574-08-30',
                'death_date' => '1634-01-17',
                'birth_place' => 'Szenc',
                'death_place' => 'Kolozsvár',
                'biography' => 'Nyelvész, bibliafordító, zsoltáríró, református teológus.',
                'occupation' => 'Linguist, Theologian',
                'image_url' => 'https://example.com/images/szenczi.jpg',
            ],
            [
                'first_name' => 'Miklós',
                'last_name' => 'Jósika',
                'birth_date' => '1794-04-28',
                'death_date' => '1865-02-27',
                'birth_place' => 'Torda',
                'death_place' => 'Drezda',
                'biography' => 'Író, politikus, az első magyar romantikus regény szerzője.',
                'occupation' => 'Writer, Politician',
                'image_url' => 'https://example.com/images/josika.jpg',
            ],
            [
                'first_name' => 'Kata',
                'last_name' => 'Bethlen',
                'birth_date' => '1700-10-25',
                'death_date' => '1759-07-28',
                'birth_place' => 'Kisbún',
                'death_place' => 'Fogaras',
                'biography' => 'Író, protestáns vallásvédő, erdélyi főnemes.',
                'occupation' => 'Writer, Noblewoman',
                'image_url' => 'https://example.com/images/bethlenkata.jpg',
            ],
            [
                'first_name' => 'Miklós',
                'last_name' => 'Misztótfalusi Kis',
                'birth_date' => '1650-03-20',
                'death_date' => '1702-03-20',
                'birth_place' => 'Misztótfalu',
                'death_place' => 'Kolozsvár',
                'biography' => 'Nyomdász, betűmetsző, a magyar nyomdászat kiemelkedő alakja.',
                'occupation' => 'Typographer, Printer',
                'image_url' => 'https://example.com/images/misztotfalusi.jpg',
            ],
            [
                'first_name' => 'Sámuel',
                'last_name' => 'Brassai',
                'birth_date' => '1800-06-15',
                'death_date' => '1897-06-24',
                'birth_place' => 'Torockószentgyörgy',
                'death_place' => 'Kolozsvár',
                'biography' => 'Tudós polihisztor, nyelvész, matematikus, filozófus.',
                'occupation' => 'Polymath, Linguist',
                'image_url' => 'https://example.com/images/brassai.jpg',
            ],
            [
                'first_name' => 'Domokos',
                'last_name' => 'Szilágyi',
                'birth_date' => '1938-07-02',
                'death_date' => '1976-11-02',
                'birth_place' => 'Nagysomkút',
                'death_place' => 'Kolozsvár',
                'biography' => '20. századi magyar költő, az erdélyi líra kiemelkedő alakja.',
                'occupation' => 'Poet',
                'image_url' => 'https://example.com/images/szilagyi.jpg',
            ],
            [
                'first_name' => 'Elek',
                'last_name' => 'Benedek',
                'birth_date' => '1859-09-30',
                'death_date' => '1929-08-17',
                'birth_place' => 'Kisbacon',
                'death_place' => 'Kisbacon',
                'biography' => 'A nagy mesemondó, író, szerkesztő, politikus.',
                'occupation' => 'Writer, Politician',
                'image_url' => 'https://example.com/images/benedekelek.jpg',
            ],
            [
                'first_name' => 'Emil',
                'last_name' => 'Racoviță',
                'birth_date' => '1868-11-15',
                'death_date' => '1947-11-17',
                'birth_place' => 'Iași',
                'death_place' => 'Kolozsvár',
                'biography' => 'Román biológus, sarkkutató, a speleológia tudományos megalapítója.',
                'occupation' => 'Biologist, Explorer',
                'image_url' => 'https://example.com/images/racovita.jpg',
            ],
        ];

        foreach ($persons as $index => $data) {
            $lat = 46.76345066378609 + (rand(-35, 35) * 0.0001);
            $lng = 23.593751816660532 + (rand(-35, 35) * 0.0001);
            $location = Point::makeGeodetic($lat, $lng);
            $grave = Grave::create([
                'cemetery_id' => $cemetery->id,
                'name' => 'A-' . ($index + 13),
                'location' => $location,
                'boundary' => Polygon::make(
                    [LineString::make(
                        [
                            $location,
                            Point::makeGeodetic($lat + (rand(-25,25) * 0.00001), $lng + rand(-25, 25) * 0.00001),
                            Point::makeGeodetic($lat + (rand(-25,25) * 0.00001), $lng + rand(-25, 25) * 0.00001),
                            Point::makeGeodetic($lat + (rand(-25,25) * 0.00001), $lng + rand(-25, 25) * 0.00001),
                            $location,
                        ]
                    )]
                )
            ]);

            Person::create(array_merge($data, [
                'grave_id' => $grave->id,
            ]));
        }

        $this->call([
            CemeterySeeder::class
        ]);

    }
}
