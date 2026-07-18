<?php
// =============================================================================
// FluxCP Server Configuration (Docker-friendly)
//
// Reads database and server connection details from environment variables
// set in .env / docker-compose.yml. Falls back to defaults if not set.
// =============================================================================

// Helper: get env var or fallback
function env($key, $default = null) {
    $val = getenv($key);
    return $val !== false ? $val : $default;
}

// Read server details from environment
$dbHostname   = env('FLUXCP_DB_HOSTNAME', 'db');
$dbUsername   = env('FLUXCP_DB_USERNAME', 'ragnarok');
$dbPassword   = env('FLUXCP_DB_PASSWORD', 'ragnarok');
$dbDatabase   = env('FLUXCP_DB_DATABASE', 'ragnarok');
$dbPort       = (int) env('FLUXCP_DB_PORT', '3306');

$serverName   = env('FLUXCP_SERVER_NAME', 'FluxRO');
$loginAddr    = env('FLUXCP_LOGIN_ADDR', 'login');
$loginPort    = (int) env('FLUXCP_LOGIN_PORT', '6900');
$charAddr     = env('FLUXCP_CHAR_ADDR', 'char');
$charPort     = (int) env('FLUXCP_CHAR_PORT', '6121');
$mapAddr      = env('FLUXCP_MAP_ADDR', 'map');
$mapPort      = (int) env('FLUXCP_MAP_PORT', '5121');

$baseExp      = (int) env('FLUXCP_BASE_EXP_RATE', '100');
$jobExp       = (int) env('FLUXCP_JOB_EXP_RATE', '100');
$mvpExp       = (int) env('FLUXCP_MVP_EXP_RATE', '100');

return array(
    array(
        'ServerName'     => $serverName,

        // ---- Main Database ----
        'DbConfig'       => array(
            'Port'       => $dbPort,
            'Convert'    => 'utf8',
            'Hostname'   => $dbHostname,
            'Username'   => $dbUsername,
            'Password'   => $dbPassword,
            'Database'   => $dbDatabase,
            'Persistent' => true,
            'Timezone'   => null,
        ),

        // ---- Logs Database ----
        'LogsDbConfig'   => array(
            'Port'       => $dbPort,
            'Convert'    => 'utf8',
            'Hostname'   => $dbHostname,
            'Username'   => $dbUsername,
            'Password'   => $dbPassword,
            'Database'   => $dbDatabase,
            'Persistent' => true,
            'Timezone'   => null,
        ),

        // ---- Web Database (FluxCP internal tables) ----
        'WebDbConfig'    => array(
            'Hostname'   => $dbHostname,
            'Username'   => $dbUsername,
            'Password'   => $dbPassword,
            'Database'   => $dbDatabase,
            'Persistent' => true,
        ),

        // ---- Login Server ----
        'LoginServer'    => array(
            'Address'  => $loginAddr,
            'Port'     => $loginPort,
            'UseMD5'   => false,
            'NoCase'   => true,
            'GroupID'  => 0,
        ),

        // ---- Char/Map Servers ----
        'CharMapServers' => array(
            array(
                'ServerName'      => $serverName,
                'Renewal'         => true,
                'MaxCharSlots'    => 9,
                'DateTimezone'    => null,

                // Exp Rates (display only, for info purposes)
                'ExpRates' => array(
                    'Base'        => $baseExp,
                    'Job'         => $jobExp,
                    'Mvp'         => $mvpExp,
                ),

                // Drop Rates (display only, for info purposes)
                'DropRates' => array(
                    'DropRateCap' => 9000,
                    'Common'      => 100,
                    'CommonBoss'  => 100,
                    'CommonMVP'   => 100,
                    'CommonMin'   => 1,
                    'CommonMax'   => 10000,
                    'Heal'        => 100,
                    'HealBoss'    => 100,
                    'HealMVP'     => 100,
                    'HealMin'     => 1,
                    'HealMax'     => 10000,
                    'Useable'     => 100,
                    'UseableBoss' => 100,
                    'UseableMVP'  => 100,
                    'UseableMin'  => 1,
                    'UseableMax'  => 10000,
                    'Equip'       => 100,
                    'EquipBoss'   => 100,
                    'EquipMVP'    => 100,
                    'EquipMin'    => 1,
                    'EquipMax'    => 10000,
                    'Card'        => 100,
                    'CardBoss'    => 100,
                    'CardMVP'     => 100,
                    'CardMin'     => 1,
                    'CardMax'     => 10000,
                    'MvpItem'     => 100,
                    'MvpItemMin'  => 1,
                    'MvpItemMax'  => 10000,
                    'MvpItemMode' => 0,
                ),

                // Char Server
                'CharServer'      => array(
                    'Address'     => $charAddr,
                    'Port'        => $charPort,
                ),

                // Map Server
                'MapServer'       => array(
                    'Address'     => $mapAddr,
                    'Port'        => $mapPort,
                ),

                // WoE Schedule (disabled by default)
                'WoeDayTimes'   => array(),
                'WoeDisallow'   => array(
                    array('module' => 'character', 'action' => 'online'),
                    array('module' => 'character', 'action' => 'mapstats'),
                ),
            )
        )
    )
);
?>
