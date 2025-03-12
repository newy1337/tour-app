<?php

namespace App\Http\Controllers\Api;

use App\Action\Pages\Main\GetMainContent;
use App\Http\Controllers\Controller;

class PageController extends Controller
{


    public function getMain(GetMainContent $getMainContent)
    {

        $res =   ['description' => 'Nec magna primis labores ex, vim cu mazim vocent. Ius modus posse invenire ei, corpora detraxit pro an, malis dolores ut has. Nam ut elit ferri patrioque, zril partem principes cum id. Sea ne assum minim quaestio, at hinc saepe graeco qui. In nec ludus repudiare scribentur, vix agam fabellas ne. Sit dicta aliquid ornatus an, sea laoreet pericula ea. Invenire voluptatum in pro, vel enim latine ne, percipit convenire eu eam.','list' =>
            ['Invenire voluptatum' => 'Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.'],
            ['Nec ludus repudiare' => 'Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.'],
            ['Sea laoreet pericula' => 'Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.'],
            ['Invenire voluptatum' => 'Lorem ipsum dolor sit amet, ei per elitr persecuti adipiscing, ne discere temporibus nam.']
        ];


        $program = [
         'content' => 'Iudico omnesque vis at, ius an laboramus adversarium. An eirmod doctus admodum est, vero numquam et mel, an duo modo error. No affert timeam mea, legimus ceteros his in. Aperiri honestatis sit at. Eos aeque fuisset ei, case denique eam ne. Augue invidunt has ad, ullum debitis mea ei, ne aliquip dignissim nec.',
          'list' =>
            [
                'duration' => '30 min',
                'time' => '09:30',
                'step' => 1,
                'image' => 'https://www.ansonika.com/bestours/travel_tours/img/tour_plan_1.jpg',
                'title' => 'Augue invidunt has',
                'description' => 'Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.'

            ],
            [
                'duration' => '2 hours',
                'time' => '11:30',
                'step' => 2,
                'image' => 'https://www.ansonika.com/bestours/travel_tours/img/tour_plan_1.jpg',
                'title' => 'An eirmod doctus admodum',
                'description' => 'Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.'


            ],
            [
                'duration' => '1 hours',
                'time' => '13:30',
                'step' => 3,
                'image' => 'https://www.ansonika.com/bestours/travel_tours/img/tour_plan_1.jpg',
                'title' => 'Eos aeque fuisset',
                'description' => 'Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.'
            ],
            [
                'duration' => '2 hours',
                'time' => '14:30',
                'step' => 4,
                'image' => 'https://www.ansonika.com/bestours/travel_tours/img/tour_plan_1.jpg',
                'title' => 'No affert timeam mea',
                'description' => 'Vero consequat cotidieque ad eam. Ea duis errem qui, impedit blandit sed eu. Ius diam vivendo ne.'


            ]
        ];

        return $getMainContent();


    }

}
