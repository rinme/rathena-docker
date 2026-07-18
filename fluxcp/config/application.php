<?php
// =============================================================================
// FluxCP Application Configuration (Docker-friendly)
//
// Reads values from environment variables set in .env / docker-compose.yml.
// Falls back to sensible defaults if env vars are not set.
// =============================================================================

return array(
    // ---- General ----
    'ServerAddress'             => getenv('FLUXCP_SERVER_ADDRESS') ?: 'localhost',
    'BaseURI'                   => getenv('FLUXCP_BASE_URI') ?: '/',
    'ForceHTTPS'                => (getenv('FLUXCP_FORCE_HTTPS') ?: 'false') === 'true',
    'InstallerPassword'         => getenv('FLUXCP_INSTALLER_PASSWORD') ?: 'secretpassword',
    'RequireOwnership'          => false,
    'DefaultLoginGroup'         => null,
    'DefaultCharMapServer'      => null,
    'DefaultLanguage'           => 'en_us',
    'SiteTitle'                 => getenv('FLUXCP_SITE_TITLE') ?: 'Flux Control Panel',
    'ThemeName'                 => array('default', 'bootstrap'),
    'ScriptTimeLimit'           => 0,

    // ---- Visual / Display ----
    'MissingEmblemBMP'          => 'empty.bmp',
    'ItemIconNameFormat'        => '%d.png',
    'ItemImageNameFormat'       => '%d.png',
    'MonsterImageNameFormat'    => '%d.gif',
    'JobImageNameFormat'        => '%d.gif',
    'DivinePrideIntegration'    => true,
    'ForceEmptyEmblem'          => false,
    'EmblemCacheInterval'       => 12,
    'EmblemUseWebservice'       => true,
    'SessionCookieExpire'       => 48,
    'AdminMenuGroupLevel'       => 10,

    // ---- Dates / Time ----
    'DateDefaultTimezone'       => getenv('FLUXCP_TIMEZONE') ?: 'UTC',
    'DateFormat'                => 'Y-m-d',
    'DateTimeFormat'            => 'Y-m-d H:i:s',

    // ---- Paging ----
    'ShowSinglePage'            => true,
    'ResultsPerPage'            => 20,
    'PagesToShow'               => 10,
    'PageJumpMinimumPages'      => 1,
    'ShowPageJump'              => true,
    'SingleMatchRedirect'       => true,
    'SingleMatchRedirectItem'   => false,
    'SingleMatchRedirectMobs'   => false,

    // ---- Account Registration ----
    'UsernameAllowedChars'      => 'a-zA-Z0-9_',
    'MinUsernameLength'         => 4,
    'MaxUsernameLength'         => 23,
    'MinPasswordLength'         => 8,
    'MaxPasswordLength'         => 31,
    'PasswordMinUpper'          => 1,
    'PasswordMinLower'          => 1,
    'PasswordMinNumber'         => 1,
    'PasswordMinSymbol'         => 0,
    'GMMinPasswordLength'       => 8,
    'GMPasswordMinUpper'        => 1,
    'GMPasswordMinLower'        => 1,
    'GMPasswordMinNumber'       => 1,
    'GMPasswordMinSymbol'       => 1,
    'RandomPasswordLength'      => 16,
    'AllowUserInPassword'       => false,
    'AllowDuplicateEmails'      => false,
    'RequireEmailConfirm'       => false,
    'RequireChangeConfirm'      => false,
    'EmailConfirmExpire'        => 48,
    'AccountEmailLength'        => 39,
    'AccountGenderLength'       => 1,
    'AccountGroupIDLength'      => 11,
    'AccountLoginCountLength'   => 11,
    'AccountStateLength'        => 11,

    // ---- Character Settings ----
    'PincodeEnabled'            => true,
    'CharSlotCount'             => 9,
    'CharMaxBaseLevel'          => 99,
    'CharMaxJobLevel'           => 50,
    'CharMaxStatsPoints'        => 99,
    'CharMaxSkillPoints'        => 49,
    'CharMaxCartWeight'         => 8000,
    'CharMaxItemWeight'         => 46000,
    'CharMaxStorage'            => 600,
    'CharMaxCart'               => 30,
    'CharMaxInventory'          => 100,
    'CharMaxParty'              => 12,
    'CharMaxGuild'              => 16,
    'CharMaxPartyMembers'       => 12,
    'CharMaxGuildMembers'       => 16,

    // ---- Mailer ----
    'MailerFromAddress'         => getenv('FLUXCP_MAILER_FROM') ?: 'noreply@localhost',
    'MailerFromName'            => getenv('FLUXCP_MAILER_NAME') ?: 'FluxCP',
    'MailerUseSMTP'             => false,
    'MailerSMTPUseSSL'          => false,
    'MailerSMTPUseTLS'          => false,
    'MailerSMTPPort'            => null,
    'MailerSMTPHosts'           => null,
    'MailerSMTPUsername'        => null,
    'MailerSMTPPassword'        => null,

    // ---- Server Status ----
    'ServerStatusCache'         => 2,
    'ServerStatusTimeout'       => 2,

    // ---- Session ----
    'SessionKey'                => 'fluxSessionData',
    'DefaultModule'             => 'main',
    'DefaultAction'             => 'index',

    // ---- Output ----
    'GzipCompressOutput'        => false,
    'GzipCompressionLevel'      => 9,
    'OutputCleanHTML'           => true,
    'ShowCopyright'             => true,
    'ShowRenderDetails'         => true,
    'UseCleanUrls'              => true,
    'DebugMode'                 => false,

    // ---- Captcha / Security ----
    'UseCaptcha'                => false,
    'UseLoginCaptcha'           => false,
    'EnableReCaptcha'           => false,
    'ReCaptchaPublicKey'        => '',
    'ReCaptchaPrivateKey'       => '',
    'ReCaptchaTheme'            => 'light',
    'IpWhitelistPattern'        => '(127\.0\.0\.1|0(\.[0\*]){3}|172\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}|10\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}|192\.168\.[0-9]{1,3}\.[0-9]{1,3})',

    // ---- Bans ----
    'AllowIpBanLogin'           => false,
    'AllowTempBanLogin'         => false,
    'AllowPermBanLogin'         => false,
    'AutoRemoveTempBans'        => true,

    // ---- Donations ----
    'DisplayCashPoints'         => false,
    'CreditExchangeRate'        => 1.0,
    'MinDonationAmount'         => 2.0,
    'DonationCurrency'          => 'USD',
    'MoneyDecimalPlaces'        => 2,
    'MoneyThousandsSymbol'      => ',',
    'MoneyDecimalSymbol'        => '.',
    'AcceptDonations'           => false,
    'PayPalIpnUrl'              => 'ipnpb.paypal.com',
    'PayPalBusinessEmail'       => 'admin@localhost',
    'PayPalReceiverEmails'      => array(),
    'PaypalHackNotify'          => true,
    'PayPalAllowedHosts'        => array(
        'ipn.sandbox.paypal.com',
        'notify.paypal.com',
    ),

    // ---- Guild ----
    'GStorageLeaderOnly'        => false,
    'DivorceKeepChild'          => false,
    'DivorceKeepRings'          => false,

    // ---- Item Shop ----
    'ItemShopMaxCost'           => 99,
    'ItemShopMaxQuantity'       => 99,
    'ItemShopItemPerPage'       => 5,
    'ShowItemDesc'              => false,
    'ShopImageExtensions'       => array('png', 'jpg', 'gif', 'bmp', 'jpeg'),

    // ---- Rankings ----
    'CharRankingLimit'          => 20,
    'GuildRankingLimit'         => 20,
    'ZenyRankingLimit'          => 20,
    'DeathRankingLimit'         => 20,
    'AlchemistRankingLimit'     => 20,
    'BlacksmithRankingLimit'    => 20,
    'HomunRankingLimit'         => 20,
    'MVPRankingLimit'           => 20,

    // ---- Misc ----
    'UseLoginAccountGroup'      => false,
    'LoginAccountGroup'         => 0,
    'AllowMD5PasswordSearch'    => false,
    'ReallyAllowMD5PasswordSearch' => false,
    'TidyIgnore'                => array(
        array('module' => 'captcha'),
        array('module' => 'guild', 'action' => 'emblem'),
    ),
    'ForwardYears'              => 15,
    'BackwardYears'             => 60,
    'ColumnSortAscending'       => ' ▲',
    'ColumnSortDescending'      => ' ▼',
    'DisplaySinglePages'        => true,
    'ChargeGenderChange'        => 0,
    'HideFromWhosOnline'        => 10,
    'HideFromMapStats'          => 10,
    'RankingHideGroupLevel'     => 10,
    'BanPaymentStatuses'        => array('Cancelled_Reversal', 'Reversed'),
    'HoldUntrustedAccount'      => 0,
    'AutoUnholdAccount'         => false,
    'AutoPruneAccounts'         => false,

    // ---- Tables (include from FluxCP core) ----
    'JobClasses'                => include('jobs.php'),
    'AlchemistJobClasses'       => include('jobs_alchemist.php'),
    'BlacksmithJobClasses'      => include('jobs_blacksmith.php'),
    'GenderLinkedJobClasses'    => include('jobs_gender_linked.php'),
    'HomunClasses'              => include('homunculus.php'),
    'ItemTypes'                 => include('itemtypes.php'),
    'ItemSubTypes'              => include('itemsubtypes.php'),
    'EquipLocationCombinations' => include('equip_location_combinations.php'),
    'LoginErrors'               => include('loginerrors.php'),
    'EquipJobs'                 => include('equip_jobs.php'),
    'EquipLocations'            => include('equip_locations.php'),
    'EquipUpper'                => include('equip_upper.php'),
    'MonsterSizes'              => include('sizes.php'),
    'MonsterRaces'              => include('races.php'),
    'Elements'                  => include('elements.php'),
    'Attributes'                => include('attributes.php'),
    'MonsterModes'              => include('monstermode.php'),
    'MonsterAI'                 => include('monster_ai.php'),
    'ShopCategories'            => include('shopcategories.php'),
    'PickTypes'                 => include('picktypes.php'),
    'FeedingTypes'              => include('feedingtypes.php'),
    'CastleNames'               => include('castlenames.php'),
    'TradeRestriction'          => include('trade_restrictions.php'),
    'ItemFlags'                 => include('itemsflags.php'),
    'RandomOptions'             => include('item_randoptions.php'),

    // ---- FluxCP internal tables ----
    'FluxTables'                => array(
        'CreditsTable'              => 'cp_credits',
        'CreditTransferTable'       => 'cp_xferlog',
        'ItemShopTable'             => 'cp_itemshop',
        'TransactionTable'          => 'cp_txnlog',
        'RedemptionTable'           => 'cp_redeemlog',
        'AccountCreateTable'        => 'cp_createlog',
        'AccountBanTable'           => 'cp_banlog',
        'IpBanTable'                => 'cp_ipbanlog',
        'DonationTrustTable'        => 'cp_trusted',
        'AccountPrefsTable'         => 'cp_loginprefs',
        'CharacterPrefsTable'       => 'cp_charprefs',
        'ResetPasswordTable'        => 'cp_resetpass',
        'ChangeEmailTable'          => 'cp_emailchange',
        'LoginLogTable'             => 'cp_loginlog',
        'ChangePasswordTable'       => 'cp_pwchange',
        'OnlinePeakTable'           => 'cp_onlinepeak',
        'CMSNewsTable'              => 'cp_cmsnews',
        'CMSPagesTable'             => 'cp_cmspages',
        'CMSSettingsTable'          => 'cp_cmssettings',
        'ServiceDeskTable'          => 'cp_servicedesk',
        'ServiceDeskATable'         => 'cp_servicedeska',
        'ServiceDeskCatTable'       => 'cp_servicedeskcat',
        'ServiceDeskSettingsTable'  => 'cp_servicedesksettings',
        'WebCommandsTable'          => 'cp_commands',
        'ItemDescTable'             => 'cp_itemdesc',
    )
);
?>
