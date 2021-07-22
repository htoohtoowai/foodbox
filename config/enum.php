<?php

return [
    'perPage'=>10,
    'member' =>[
        'levelOne' => 1, /***##Donor and Donee##****/
        'LevelTwo'=>2 /***##Data Entry##****/
    ],
    'status'=>[
        'require' => 1,
        'inprogress' => 2,
        'done' => 3
    ],
    'takeStatus'=>[
        'all'=>1,
        'custom'=>2
    ],
    'donateStatus'=>[
        'all'=>1,
        'custom'=>2
    ]
];
