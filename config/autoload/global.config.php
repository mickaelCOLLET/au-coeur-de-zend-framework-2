<?php
return array(
    'di' => array(
        'alias' => array(
            'ZFBTwitterOptions' => 'ZFBook\Service\Twitter\TwitterOptions',
        ),
        'instance' => array(
            'ZFBook\Service\Twitter\TwitterOptions' => array(
                'parameters' => array(
                    'queries' => array(
                        '#zf2', 'zend framework 2', '#zendframework2', '#zf2conf'
                    ),
                    'languages' => array(
                        'fr', 'en'
                    ),
                ),
            ),
        ),
    ),
);
