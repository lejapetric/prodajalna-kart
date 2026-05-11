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
        }
        
        h1::before, h1::after {
            content: "✏️";
            font-size: 2.5rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        
        h1::before { left: 10%; }
        h1::after { right: 10%; }
        
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
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            color: var(--gold);
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 15px;
            border: 2px solid var(--gold);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.95);
            font-size: 1.1rem;
            color: #333;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 15px var(--red);
            transform: translateY(-2px);
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            border: none;
            padding: 18px 35px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.2rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            display: block;
            margin: 30px auto;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
            letter-spacing: 2px;
        }
        
        .activation-section {
            background: rgba(10, 92, 54, 0.3);
            padding: 25px;
            border-radius: 15px;
            margin: 30px 0;
            border: 2px solid var(--gold);
            text-align: center;
        }
        
        .activation-btn {
            background: linear-gradient(145deg, var(--green), #0d7242);
            color: white;
            border: 2px solid var(--gold);
            padding: 15px 30px;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            margin: 15px auto;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .activation-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #0d7242, var(--green));
        }
        
        .deactivate-btn {
            background: linear-gradient(145deg, #dc3545, #c82333);
        }
        
        .activate-btn {
            background: linear-gradient(145deg, #28a745, #1e7e34);
        }
        
        .status-indicator {
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .status-active {
            color: #00ff00;
        }
        
        .status-inactive {
            color: #ff4444;
        }
        
        .footer-decoration {
            text-align: center;
            margin-top: 50px;
            font-size: 2rem;
        }
        
        @keyframes fall {
            to { transform: translateY(100vh); }
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }
        
        .christmas-light {
            position: fixed;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 20; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = `${Math.random() * 6 + 3}px`;
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                snowflake.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
                document.body.appendChild(snowflake);
            }
            
            for (let i = 0; i < 12; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                light.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                document.body.appendChild(light);
            }
        });
    </script>
    <title>Uredi karto</title>
</head>
<body>
    <h1>✏️ UREDI KARTO ✏️</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "karte" ?>">🎫 Vse karte</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Prodajalna</a> ✨
    </div>
    
    <form class="edit-form" action="<?= BASE_URL . "karta/edit" ?>" method="post">
        <input type="hidden" name="id" value="<?= $karta["id"] ?>" />
        <input type="hidden" name="aktiviran" value="<?= $karta["aktiviran"] ?>" />
        
        <div class="form-group">
            <label>🏷️ Naziv:</label>
            <input type="text" name="naziv" value="<?= $karta["naziv"] ?>" autofocus />
        </div>
        
        <div class="form-group">
            <label>💰 Cena:</label>
            <input type="text" name="cena" value="<?= $karta["cena"] ?>" />
        </div>
        
        <button class="submit-btn" type="submit">
            🎄 Posodobi zapis
        </button>
    </form>
    
    <div class="activation-section">
        <div class="status-indicator <?= $karta["aktiviran"] == 1 ? 'status-active' : 'status-inactive' ?>">
            <?php if ($karta["aktiviran"] == 1): ?>
                ✅ Karta je trenutno AKTIVIRANA
            <?php else: ?>
                ❌ Karta je trenutno DEAKTIVIRANA
            <?php endif; ?>
        </div>
        
        <?php if ($karta["aktiviran"] == 1): ?>
            <form action="<?= BASE_URL . "karta/deactivate" ?>" method="post">
                <input type="hidden" name="id" value="<?= $karta["id"] ?>" />
                <button type="submit" class="activation-btn deactivate-btn">
                    🔴 Deaktiviraj karto
                </button>
            </form>
        <?php else: ?>
            <form action="<?= BASE_URL . "karta/activate" ?>" method="post">
                <input type="hidden" name="id" value="<?= $karta["id"] ?>" />
                <button type="submit" class="activation-btn activate-btn">
                    🟢 Aktiviraj karto
                </button>
            </form>
        <?php endif; ?>
    </div>
    
    <div class="footer-decoration">
        🎄🎫✨✏️🔔🎁
    </div>
</body>
</html>