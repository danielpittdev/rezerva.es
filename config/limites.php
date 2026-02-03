<?php

/**
 * Límites de recursos por plan de suscripción.
 *
 * Cada clave es el slug del plan (coincide con el campo 'type' de la suscripción).
 * Los valores definen el máximo de cada recurso que puede crear el usuario.
 */

return [
    'plus-rfid-1' => [
        'negocios'  => 1,
        'clientes'  => 3,
        'empleados' => 2,
        'servicios' => 5,
    ],
    'pro-rfid-1' => [
        'negocios'  => 5,
        'clientes'  => 10,
        'empleados' => 10,
        'servicios' => 20,
    ],
];
