<?php
namespace es\ucm\fdi\aw;
use es\ucm\fdi\aw\Aplicacion as Aplicacion;

class Usuario
{

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return self::cargaRoles($usuario);
        }
        return false;
    }
    
    public static function crea($email, $nombreUsuario, $nombre, $password, $direccion, $codPostal, $imgPerfil, $rol)
    {   
        $user = new Usuario($email, self::hashPassword($password), $nombreUsuario, $codPostal, $nombre, $direccion, $imgPerfil, $rol);
        $user->añadeRol($rol);
        return $user->guarda();
    }

    public static function editarDatos($email_usuario, $nombreUsuario,$nombre,$direccion,$codPostal,$password,$imgPerfil){
        
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        echo $password;
        $pass = self::hashPassword($password);
        $query=sprintf("UPDATE usuarios SET Nombreusuario = '$nombreUsuario', Código_Postal='$codPostal', Nombre='$nombre', Dirección='$direccion', Contraseña='$pass', FotoPerfil ='$imgPerfil' 
            WHERE Correo= '$email_usuario'");

            $rs = $conn->query($query);
        if ($rs) {
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;

    }

    public static function buscaUsuarios() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios U");
        $rs = $conn->query($query);
        $result = [];
        $i = 0;
        if ($rs) {
            foreach ($rs as $fila) {
                $result[$i] = new Usuario($fila['ID'], $fila['Correo'], $fila['Contraseña'], 
                                $fila['Nombreusuario'], $fila['Código_Postal'], $fila['Nombre'], 
                                $fila['Dirección'], $fila['FotoPerfil']);
                $i++;
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.Nombreusuario='%s'", $conn->real_escape_string($nombreUsuario));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['ID'], $fila['Correo'], $fila['Contraseña'], 
                $fila['Nombreusuario'], $fila['Código_Postal'], $fila['Nombre'], 
                $fila['Dirección'], $fila['FotoPerfil']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['ID'], $fila['Correo'], $fila['Contraseña'], 
                $fila['Nombreusuario'], $fila['Código_Postal'], $fila['Nombre'], 
                $fila['Dirección'], $fila['FotoPerfil'], $fila ['Roles']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    public static function agregaRol($usuario, $rol) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("INSERT INTO rolesusuario(usuario, rol) VALUES (%d, %d)"
            , $usuario->id
            , $rol
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return $usuario;
    }

    public static function devuelveRoles($usuario) {
        return self::cargaRoles($usuario);
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRoles($usuario)
    {
        $roles=[];
            
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT RU.rol FROM rolesusuario RU WHERE RU.usuario=%d"
            , $usuario->id
        );
        $rs = $conn->query($query);
        if ($rs) {
            $roles = $rs->fetch_all(MYSQLI_ASSOC);
            $rs->free();

            $usuario->roles = [];
            foreach($roles as $rol) {
                $usuario->roles[] = $rol['rol'];
            }

            return $usuario;

        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return false;
    }
   
    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO usuarios(Correo, Contraseña, Nombreusuario, Código_Postal, Nombre, Dirección, FotoPerfil) VALUES 
            ('%s', '%s', '%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->codPostal)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->imagen)
        );
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            $result = self::insertaRoles($usuario);
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    private static function insertaRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        foreach($usuario->roles as $rol) {
            $query = sprintf("INSERT INTO rolesusuario(usuario, rol) VALUES (%d, %d)"
                , $usuario->id
                , $rol
            );
            if ( ! $conn->query($query) ) {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }
        return $usuario;
    }
    

    private static function actualiza($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE usuarios U SET Correo = '%s', Contraseña = '%s', Nombreusuario = '%s', Código_Postal='%s', Nombre='%s', Dirección='%s', FotoPerfil='%s' WHERE U.id=%d"
            , $conn->real_escape_string($usuario->email)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->codPostal)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->direccion)
            , $conn->real_escape_string($usuario->imagen)
            , $usuario->id
        );
        if ( $conn->query($query) ) {
            $result = self::borraRoles($usuario);
            if ($result) {
                $result = self::insertaRoles($usuario);
            }
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }
   
    private static function borraRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM rolesususario RU WHERE RU.usuario = %d"
            , $usuario->id
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return $usuario;
    }
    
    private static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
    }
    
    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        } 
        /* Los roles se borran en cascada por la FK
         * $result = self::borraRoles($usuario) !== false;
         */
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("DELETE FROM usuarios U WHERE U.id = %d"
            , $idUsuario
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    private $id;

    private $email;

    private $nombreUsuario;

    private $password;

    private $codPostal;

    private $direccion;

    private $imagen;

    private $nombre;

    private $roles;

    private function __construct($id = null, $email, $password, $nombreUsuario, $codPostal, $nombre, $direccion, $imagen, $roles = [])
    {
        $this->id = $id;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->codPostal = $codPostal;
        $this->imagen = $imagen;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->roles = $roles;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
    public function getdireccion()
    {
        return $this->direccion;
    }

    public function getcodPostal()
    {
        return $this->codPostal;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function añadeRol($role)
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function tieneRol($role)
    {
        if ($this->roles == null) {
            self::cargaRoles($this);
        }
        return array_search($role, $this->roles) !== false;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }
    
    public function guarda()
    {
        /*if ($this->id !== null) {
            return self::actualiza($this);
        }*/
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}
