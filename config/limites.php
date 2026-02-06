<?php

/**
 * Límites de recursos por plan de suscripción.
 *
 * Cada clave es el slug del plan (coincide con el campo 'type' de la suscripción).
 * Los valores definen el máximo de cada recurso que puede crear el usuario.
 */

return [
    'nonsus' => [
        'negocios'  => 1,
        'clientes'  => 0,
        'empleados' => 0,
        'servicios' => 1,
        'pago_online' => false,
    ],
    'plus-pn1' => [
        'negocios'  => 1,
        'clientes'  => 10,
        'empleados' => 3,
        'servicios' => 5,
        'pago_online' => false,
    ],
    'pro-pn1' => [
        'negocios'  => 5,
        'clientes'  => 30,
        'empleados' => 10,
        'servicios' => 15,
        'pago_online' => true,
    ],
];
