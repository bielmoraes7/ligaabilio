<?php
session_start(); // Inicia a sessão

// Verifica se o usuário não está logado
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html'); // Redireciona para a página de login
    exit;
}
?>
<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$user = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Inserir no banco de dados
$sql = "INSERT INTO usuarios (username, password) VALUES ('$user', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados do formulário
$user = $_POST['username'];
$pass = $_POST['password'];

// Buscar usuário no banco de dados
$sql = "SELECT * FROM usuarios WHERE username = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Verificar senha
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
        echo "Login bem-sucedido!";
        // Iniciar sessão ou redirecionar para página protegida
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}
$_SESSION['loggedin'] = TRUE;
$_SESSION['name'] = $user; // O nome de usuário que foi logado

$conn->close();
?>
<?php
session_start();
session_destroy(); // Destrói a sessão e faz logout
header('Location: login.html'); // Redireciona para a página de login
?>
