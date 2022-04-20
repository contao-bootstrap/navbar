<?php

declare(strict_types=1);

if (isset($GLOBALS['BE_MOD']['design']['themes']['stylesheet'])) {
    if (! is_array($GLOBALS['BE_MOD']['design']['themes']['stylesheet'])) {
        $GLOBALS['BE_MOD']['design']['themes']['stylesheet'] = [$GLOBALS['BE_MOD']['design']['themes']['stylesheet']];
    }
} else {
    $GLOBALS['BE_MOD']['design']['themes']['stylesheet'] = [];
}

$GLOBALS['BE_MOD']['design']['themes']['stylesheet'][] = 'bundles/contaobootstrapnavbar/backend.css';
