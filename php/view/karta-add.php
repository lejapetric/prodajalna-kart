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
            content: "➕";
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
        
        .message {
            padding: 15px;
            border-radius: 10px;
            margin: 15px auto;
            text-align: center;
            font-weight: bold;
            max-width: 800px;
        }
        
        .error-message {
            background: rgba(255, 0, 0, 0.2);
            border: 2px solid #ffcccc;
            color: #ffcccc;
        }
        
        .success-message {
            background: rgba(0, 255, 0, 0.2);
            border: 2px solid #ccffcc;
            color: #ccffcc;
        }
        
        .add-form {
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
        
        input[type="text"],
        input[type="number"] {
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
            margin: 40px auto 0;
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
        
        .seller-notice {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: rgba(10, 92, 54, 0.3);
            border-radius: 15px;
            border: 2px dashed var(--gold);
            color: var(--gold);
            font-size: 1.1rem;
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
        
        .ticket-ornament {
            position: fixed;
            font-size: 2rem;
            z-index: -1;
            animation: float 5s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 0; i < 25; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.style.width = `${Math.random() * 8 + 4}px`;
                snowflake.style.height = snowflake.style.width;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                snowflake.style.animation = `fall ${Math.random() * 10 + 10}s linear infinite`;
                document.body.appendChild(snowflake);
            }
            
            for (let i = 0; i < 15; i++) {
                const light = document.createElement('div');
                light.classList.add('christmas-light');
                const colors = ['#ff0000', '#00ff00', '#ffff00'];
                light.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                light.style.left = `${Math.random() * 100}vw`;
                light.style.top = `${Math.random() * 100}vh`;
                document.body.appendChild(light);
            }
            
            for (let i = 0; i < 3; i++) {
                const ornament = document.createElement('div');
                ornament.classList.add('ticket-ornament');
                ornament.innerHTML = '🎫';
                ornament.style.left = `${Math.random() * 90 + 5}vw`;
                ornament.style.top = `${Math.random() * 90 + 5}vh`;
                ornament.style.animationDelay = `${i * 1.5}s`;
                document.body.appendChild(ornament);
            }
        });
    </script>
    <title>Ustvari karto</title>
</head>
<body>
    <h1>🎫 USTVARI KARTO 🎫</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "karte" ?>">🎫 Vse karte</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">🏪 Prodajalna</a> ✨
    </div>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="message error-message">
            ⚠️ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="message success-message">
            ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <form class="add-form" action="<?= BASE_URL . "karta/add" ?>" method="post">
        <div class="form-group">
            <label>🏷️ Naziv karte:</label>
            <input type="text" name="naziv" value="<?= isset($naziv) ? htmlspecialchars($naziv) : '' ?>" autofocus required 
                   placeholder="Vnesite ime karte..." />
        </div>
        
        <div class="form-group">
            <label>💰 Cena (EUR):</label>
            <input type="number" name="cena" step="0.01" min="0" value="<?= isset($cena) ? htmlspecialchars($cena) : '' ?>" required 
                   placeholder="0.00" />
        </div>
        
        <button class="submit-btn" type="submit">
            🎄 Vstavi karto
        </button>
    </form>
    
    <div class="seller-notice">
        <?php 
        if (isset($_SESSION["user"]["email"])) {
            echo "🎅 Pozdravljeni, " . htmlspecialchars($_SESSION["user"]["name"]) . "! Dodajate novo božično vstopnico.";
        } else {
            echo "🔒 Prijavite se kot prodajalec za dodajanje kart.";
        }
        ?>
    </div>
    
    <div class="footer-decoration">
        🎄🎫✨➕🔔🎁
    </div>
</body>
</html>