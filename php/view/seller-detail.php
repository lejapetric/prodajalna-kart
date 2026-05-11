<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
    <meta charset="UTF-8" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mountains+of+Christmas:wght@400;700&family=Poppins:wght@300;400;600&display=swap');
        
        :root {
            --red: #c41e3a;
            --green: #0a5c36;
            --gold: #ffd700;
            --white: #fffaf0;
            --blue: #1e3a5f;
        }
        
        body {
            background: linear-gradient(135deg, #0a5c36 0%, #0d7242 25%, #c41e3a 50%, #8b0000 75%, #1e3a5f 100%);
            font-family: 'Poppins', sans-serif;
            color: var(--white);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        .snowflake {
            position: fixed;
            background-color: white;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.8;
            z-index: 1000;
        }
        
        h1 {
            font-family: 'Mountains of Christmas', cursive;
            font-size: 3.5rem;
            text-align: center;
            color: var(--gold);
            margin: 30px 0;
            padding: 20px;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.7);
            position: relative;
            letter-spacing: 2px;
        }
        
        h1::before, h1::after {
            content: "🎅";
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        h1::before { left: 5%; }
        h1::after { right: 5%; }
        
        .nav-links {
            background: rgba(30, 58, 95, 0.7);
            padding: 15px;
            border-radius: 15px;
            margin: 20px auto;
            max-width: 600px;
            border: 2px solid var(--gold);
            text-align: center;
        }
        
        .nav-links a {
            color: var(--gold);
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 5px;
        }
        
        .nav-links a:hover {
            color: var(--white);
            background: rgba(196, 30, 58, 0.7);
            text-shadow: 0 0 10px var(--gold);
        }
        
        .edit-form {
            background: rgba(30, 58, 95, 0.8);
            padding: 30px;
            border-radius: 20px;
            border: 3px solid var(--gold);
            max-width: 600px;
            margin: 30px auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--gold);
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gold);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 10px var(--red);
        }
        
        .status-section {
            background: rgba(10, 92, 54, 0.3);
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 2px dashed var(--gold);
        }
        
        .status-section strong {
            color: var(--gold);
            font-size: 1.2rem;
            display: block;
            margin-bottom: 15px;
        }
        
        .status-option {
            display: inline-block;
            margin-right: 30px;
            cursor: pointer;
        }
        
        .status-option input[type="radio"] {
            margin-right: 10px;
            transform: scale(1.2);
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: block;
            margin: 30px auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        
        .back-link a {
            color: var(--gold);
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 2px solid var(--gold);
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            background: var(--gold);
            color: var(--blue);
        }
        
        /* Božične animacije */
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        .christmas-ornament {
            position: fixed;
            width: 30px;
            height: 30px;
            background: var(--red);
            border-radius: 50%;
            z-index: -1;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        .christmas-light {
            position: fixed;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
        
        .footer-decoration {
            text-align: center;
            margin-top: 50px;
            font-size: 2rem;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ustvari snežinke
            for (let i = 0; i < 25; i++) {
                createSnowflake();
            }
            
            // Ustvari lučke
            for (let i = 0; i < 15; i++) {
                createLight();
            }
            
            // Ustvari okraske
            for (let i = 0; i < 10; i++) {
                createOrnament();
            }
        });
        
        function createSnowflake() {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            
            const size = Math.random() * 8 + 4;
            snowflake.style.width = `${size}px`;
            snowflake.style.height = `${size}px`;
            snowflake.style.left = `${Math.random() * 100}vw`;
            snowflake.style.top = `${Math.random() * 100}vh`;
            
            const duration = Math.random() * 10 + 10;
            snowflake.style.animation = `fall ${duration}s linear infinite`;
            
            document.body.appendChild(snowflake);
        }
        
        function createLight() {
            const light = document.createElement('div');
            light.classList.add('christmas-light');
            
            const colors = ['#ff0000', '#00ff00', '#ffff00', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            light.style.backgroundColor = color;
            light.style.left = `${Math.random() * 100}vw`;
            light.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(light);
        }
        
        function createOrnament() {
            const ornament = document.createElement('div');
            ornament.classList.add('christmas-ornament');
            
            const colors = ['#c41e3a', '#0a5c36', '#ffd700', '#ffffff'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            ornament.style.backgroundColor = color;
            ornament.style.left = `${Math.random() * 100}vw`;
            ornament.style.top = `${Math.random() * 100}vh`;
            
            document.body.appendChild(ornament);
        }
    </script>
    <title>Podrobnosti prodajalca</title>
</head>
<body>
    <h1>🎄 Podrobnosti o: <?= $user["surname"]?> <?=$user["name"] ?> 🎄</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "store" ?>">Prodajalna</a> ✨ |
        ✨ <a href="<?= BASE_URL . "buyers" ?>">Vsi kupci</a> ✨ |
        ✨ <a href="<?= BASE_URL . "sellers" ?>">Vsi prodajalci</a> ✨
    </div>
    
    <form class="edit-form" action="<?= BASE_URL . "sellers" ?>" method="post">
        <input type="hidden" name="id" value="<?= $user["id"] ?>"/>
        
        <div class="form-group">
            <label>🎅 Ime:</label>
            <input type="text" name="name" value="<?= $user["name"] ?>" />
        </div>
        
        <div class="form-group">
            <label>🧑 Priimek:</label>
            <input type="text" name="surname" value="<?= $user["surname"] ?>" />
        </div>
        
        <div class="form-group">
            <label>📧 Email:</label>
            <input type="email" name="email" value="<?= $user["email"] ?>" />
        </div>
        
        <div class="form-group">
            <label>🔑 Novo geslo (pustite prazno, če ne želite spremeniti):</label>
            <input type="password" name="password" />
        </div>
        
        <div class="status-section">
            <strong>🎁 Status prodajalca:</strong>
            <div class="status-option">
                <label>
                    <input type="radio" name="aktiviran" value="1"
                           <?= $user["aktiviran"] == 1 ? "checked" : "" ?>>
                    🟢 AKTIVIRAN
                </label>
            </div>
            <div class="status-option">
                <label>
                    <input type="radio" name="aktiviran" value="0"
                           <?= $user["aktiviran"] == 0 ? "checked" : "" ?>>
                    🔴 DEAKTIVIRAN
                </label>
            </div>
        </div>
        
        <input type="hidden" name="old_email" value="<?= $user["email"] ?>"/>
        
        <button class="submit-btn" type="submit">
            🎄 Posodobi zapis
        </button>
    </form>
    
    <div class="back-link">
        <a href="<?= BASE_URL . "sellers" ?>">🎅 Nazaj na seznam prodajalcev 🎅</a>
    </div>
    
    <div class="footer-decoration">
        🎄🎅✨🦌🔔❄️
    </div>
</body>
</html>