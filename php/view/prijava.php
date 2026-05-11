<!DOCTYPE html>
<html lang="sl">
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
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        
        .container {
            max-width: 500px;
            width: 90%;
            margin-top: 30px;
            z-index: 1;
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
        
        .login-form {
            background: rgba(30, 58, 95, 0.8);
            border: 3px solid var(--gold);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        h2 {
            color: var(--gold);
            font-family: 'Mountains of Christmas', cursive;
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--red);
            padding-bottom: 10px;
        }
        
        .deactivated-notice {
            background-color: rgba(255, 193, 7, 0.2);
            border: 2px solid #ffc107;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            color: #ffc107;
            font-weight: bold;
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
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--gold);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            color: #333;
            box-sizing: border-box;
        }
        
        input:focus {
            outline: none;
            border-color: var(--red);
            box-shadow: 0 0 10px var(--red);
        }
        
        .submit-btn {
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: block;
            margin: 30px auto;
            width: 200px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            background: linear-gradient(145deg, #ff2e2e, var(--red));
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gold);
            font-size: 1.1rem;
            padding: 15px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 10px;
            border: 1px dashed var(--gold);
        }
        
        .register-link a {
            color: var(--gold);
            text-decoration: underline;
            font-weight: bold;
        }
        
        .register-link a:hover {
            color: var(--white);
        }
        
        .footer-decoration {
            text-align: center;
            margin: 50px 0 30px;
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
            width: 10px;
            height: 10px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 30; i++) {
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
            
            for (let i = 0; i < 18; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                const color = colors[Math.floor(Math.random() * colors.length)];
                light.style.backgroundColor = color;
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                
                document.body.appendChild(light);
            }
        });
    </script>
    <title>Prijava</title>
</head>
<body>
    <div class="container">
        <h1>🔑 PRIJAVA 🔑</h1>
        
        <div class="nav-links">
            ✨ <a href="<?= BASE_URL . "karte" ?>">🎫 Vse karte</a> ✨ |
            ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Prodajalna</a> ✨
        </div>

        <div class="login-form">
            <form action="<?= BASE_URL . $formAction ?>" method="post">
                <h2>🎄 Vnesite podatke za prijavo:</h2>
                
                <?php if ($deactivatedNotice): ?>
                    <div class="deactivated-notice">
                        ⚠️ <?= $deactivatedNotice ?>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label>📧 E-poštni naslov:</label>
                    <input type="text" name="email" required />
                </div>
                
                <div class="form-group">
                    <label>🔐 Geslo:</label>
                    <input type="password" name="password" required />
                </div>
                
                <button class="submit-btn" type="submit">
                    🎅 Prijavi se
                </button>
                
                <div class="register-link">
                    <p>Še nimate računa? <a href="<?= BASE_URL . "registracija" ?>">Registrirajte se!</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <div class="footer-decoration">
        🎅🎄✨🔑🦌🔔
    </div>
</body>
</html>