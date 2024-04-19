<?php
class ConnexionBD
{
    private static $_dbname = "postgres";
    private static $_user = "postgres.wpufhivhhwqurjalucxt";
    private static $_pwd = "-(2id$7M2p_rJ(Y";
    private static $_host = "aws-0-eu-central-1.pooler.supabase.com";
    private static $_bdd = null;
    private function __construct()
    {
        try {
            self::$_bdd = new PDO("postgres:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8", self::$_user, self::$_pwd,    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (!self::$_bdd) {
            new ConnexionBD();
        }
        return (self::$_bdd);
    }
}