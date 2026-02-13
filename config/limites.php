<?php

/**
 * Límites de recursos por plan de suscripción.
 *
 * Cada clave es el slug del plan (coincide con el campo 'type' de la suscripción).
 * Los valores definen el máximo de cada recurso que puede crear el usuario.
 */

return [
    // Comisión de la plataforma (porcentaje sobre pagos online)
    'platform_fee' => 5, // 5% de comisión

    'nonsus' => [
        'negocios'  => 1,
        'clientes'  => 0,
        'empleados' => 0,
        'eventos' => 100,
        'servicios' => 1,
        'pago_online' => false,
        'envio_masivo' => false,
        'evento_toppings' => false,
    ],
    'plus-pn1' => [
        'envio_masivo' => true,
        'negocios'  => 1,
        'clientes'  => 10,
        'empleados' => 3,
        'eventos' => 100,
        'servicios' => 5,
        'pago_online' => true,
        'evento_toppings' => 3,
    ],
    'pro-pn1' => [
        'envio_masivo' => true,
        'negocios'  => 5,
        'clientes'  => 30,
        'empleados' => 10,
        'eventos' => 100,
        'servicios' => 15,
        'pago_online' => true,
        'evento_toppings' => 10,
    ],
];
