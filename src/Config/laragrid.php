<?php

declare(strict_types=1);

/**
 * Here you can override default config for LaraGrid
 */
return [
    'flatpickr' => [
        /**
         * You can override default flatpickr locale here
         */
        'locale' => 'en',

        /**
         * Both options must use same output format!!!
         * Example: If you want d.m.Y, you must also specify js_date_format DD.MM.YYYY. Otherwise, you will get wrong dates.
         * I don't know why, but it is like that. If you know why, please let me know, or create PR.
         *
         * JS format is used for wire model input and url params.
         * It must be in format that is supported by daysjs library (https://day.js.org/docs/en/display/format)
         *
         * Tested formats:
         * YYYY-MM-DD, DD-MM-YYYY,
         * DD.MM.YYYY, YYYY.MM.DD,
         * DD/MM/YYYY, YYYY/MM/DD,
         *
         * Date format is used for displaying date in table
         */
        'date_format' => 'Y-m-d',
        'js_date_format' => 'YYYY-MM-DD',
    ],
];
