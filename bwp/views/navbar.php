<style>
    .navbar {
        background-color: #262626;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        height: 84px;
    }

    .navbar-left {
        order: 1;
    }

    .navbar-right {
        order: 3;
        display: flex;
        gap: 10px;
    }

    .logo {
        width: 65px;
        height: 63px;
        border-radius: 100%;
        margin-left: 1.3rem;
    }

    .nav-link {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link:hover {
        background-color: white;
        color: black;
    }

    .menu-toggle {
    display: none;
    font-size: 24px;
    color: white;
    cursor: pointer;
    order: 2;
}


    @media (max-width: 768px) {
        .navbar {
            flex-wrap: wrap;
        }

        .navbar-right {
            display: none;
            flex-direction: column;
            width: 100%;
            text-align: center;
            background-color: #262626;
            position: absolute;
            top: 84px;
            left: 0;
            padding: 10px 0;
        }

        .navbar-right.show {
            display: flex;
            width: 50%;
            left: 50%;
        }

        .menu-toggle {
            display: block;
        }
    }
</style>

<nav class="navbar">
    <div class="navbar-left">
        <img src="../img/1719748129206.png" class="logo">
    </div>
    <div class="navbar-right" id="nav-menu">
        <a href="home.php" class="nav-link">HOME</a>
        <a href="servicos.php" class="nav-link">SERVIÇOS</a>
        <a href="negocios.php" class="nav-link">NEGÓCIOS</a>
        <a href="quemsomos.php" class="nav-link">QUEM SOMOS</a>
        <a href="atendimento.php" class="nav-link">SUPORTE</a>
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
</nav>

<script>
    function toggleMenu() {
        document.getElementById("nav-menu").classList.toggle("show");
    }
</script>