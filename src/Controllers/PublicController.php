<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;

/**
 * Public Access Controller Base Class
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
abstract class PublicController implements IController
{
    protected $name = "";
    /**
     * Public Controller Base Constructor
     */
    public function __construct()
    {
        if(!isset($_SESSION["tmpUsuario"])){
            $_SESSION["startTime"] = time();
            $_SESSION["tmpUsuario"] = md5("user". random_int(10000, 99999));
        }else{
            if(isset($_SESSION["startTime"]) && ((time() - $_SESSION["startTime"]) > 86400)){
                $_SESSION["startTime"] = time();
                $_SESSION["antesUsuario"] = $_SESSION["tmpUsuario"];
                $_SESSION["tmpUsuario"] = md5("user". random_int(10000, 99999));
            }
        }

        $this->name = get_class($this);
        if (\Utilities\Security::isLogged()){
            $layoutFile = \Utilities\Context::getContextByKey("PRIVATE_LAYOUT");
            if ($layoutFile !== "") {
                \Utilities\Context::setContext(
                    "layoutFile",
                    $layoutFile
                );
                \Utilities\Nav::setNavContext();
            }
        }
    }
    /**
     * Return name of instantiated class
     *
     * @return string
     */
    public function toString() :string
    {
        return $this->name;
    }
    /**
     * Returns if http method is a post or not
     *
     * @return bool
     */
    protected function isPostBack()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }

}

?>
