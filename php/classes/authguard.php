<?php

class Auth
{
    private $mysql_link;
    private $loggedin;
    private $nome;
    private $userdata;
    private $organizacao;
    const ERR_OK = 0x0;
    const ERR_GENERIC = 0x1;
    const ERR_SQL_CONNECTION = 0x10;
    const ERR_PASSWORD_INCORRECT = 0x11;
    const ERR_USER_LOGIN_INCORRECT = 0x20;
    const ERR_USER_INACTIVE = 0x21;

    public function __construct($mysql_link){
        //session_start();
        $this->mysql_link = $mysql_link;
        $this->loggedin = false;
    }

    public function login($email, $senha)
    {
        if(!mysqli_ping($this->mysql_link)) {
            return self::ERR_SQL_CONNECTION; // Geen link
        }

        // Use declaração preparada para evitar injeção de SQL.
        $query = "SELECT id, senha, nome, organizacao FROM usuarios WHERE email = ? LIMIT 1";
        if ($stmt = $this->mysql_link->prepare($query)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 1) {
                $stmt->bind_result($id, $senhaHash, $nome, $organizacao);
                $stmt->fetch();

                if (password_verify($senha, $senhaHash)) {
                    // Atualize a tabela e inicie a sessão.
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $query2 = "UPDATE usuarios SET ip = ?, lastlogin = NOW() WHERE id = ?";
                    if ($stmt = $this->mysql_link->prepare($query2)) {
                        $stmt->bind_param("si", $ip, $id);
                        if ($stmt->execute()) {

                            $user = array(
                                'id' => $id,
                                'nome' => $nome,
                                'organizacao' => $organizacao
                            );

                            $this->userdata = $user;
                            $this->nome = $nome;
                            $this->organizacao = $organizacao;
                            $this->loggedin = true;

                            $_SESSION["nome"] = $nome;
                            $_SESSION['id'] = $id;
                            $_SESSION['organizacao'] = $organizacao;

                            return 0;
                        }
                    }

                } else {
                    return self::ERR_PASSWORD_INCORRECT;
                    echo '<p>A senha inserida está incorreta.</p>';
                }
            } else {
                return self::ERR_USER_LOGIN_INCORRECT;
                echo '<p>O email ou a senha estão incorretos.</p>';
            }

            $stmt->close();
        } else {
            echo 'Ocorreu um erro na preparação da consulta.';
        }
        $this->mysql_link->close();
        exit();
    }

    public function logout()
    {
        // Limpe todas as variáveis de sessão relacionadas ao login.
        // Exemplo:
        // unset($_SESSION["user_id"]);
        // unset($_SESSION["user_name"]);
        // unset($_SESSION["user_email"]);
        // ...

        // Redirecione o usuário para a página de login.
        header("Location: login.php");
        exit();
    }

    public function getNome() {
        return $this->nome;
    }
    public function getId() {
        return $this->id;
    }

    public function getOrganizacao() {
        return $this->organizacao;
    }

    public function getUserdata() {
        return $this->userdata;
    }

    public function isAuthenticated()
    {
        // Verifique se o usuário está autenticado.
        // Exemplo:
        // return isset($_SESSION["user_id"]);
    }
}
