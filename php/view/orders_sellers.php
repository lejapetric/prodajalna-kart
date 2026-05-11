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
            content: "🛒";
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
            max-width: 800px;
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
        
        .access-denied {
            background: rgba(196, 30, 58, 0.8);
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            border: 3px solid var(--gold);
            font-size: 1.3rem;
        }
        
        .orders-table {
            width: 100%;
            max-width: 1200px;
            margin: 30px auto;
            border-collapse: separate;
            border-spacing: 0;
            background: rgba(30, 58, 95, 0.8);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        
        .orders-table th {
            background: linear-gradient(145deg, var(--red), #8b0000);
            color: white;
            padding: 20px;
            text-align: left;
            font-size: 1.1rem;
            border-bottom: 3px solid var(--gold);
        }
        
        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 215, 0, 0.3);
            background: rgba(255, 255, 255, 0.05);
        }
        
        .orders-table tr:hover td {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .orders-table a {
            color: var(--gold);
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .orders-table a:hover {
            color: var(--white);
            text-shadow: 0 0 10px var(--gold);
        }
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
            display: inline-block;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d1ecf1; color: #0c5460; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .status-refunded { background: #e2e3e5; color: #383d41; }
        
        .seller-info {
            font-size: 0.9rem;
            color: #ccc;
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
            width: 10px;
            height: 10px;
            border-radius: 50%;
            z-index: -1;
            animation: twinkle 1.5s infinite alternate;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ustvari snežinke
            for (let i = 0; i < 25; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                
                const size = Math.random() * 6 + 3;
                snowflake.style.width = `${size}px`;
                snowflake.style.height = `${size}px`;
                snowflake.style.left = `${Math.random() * 100}vw`;
                snowflake.style.top = `${Math.random() * 100}vh`;
                
                const duration = Math.random() * 10 + 10;
                snowflake.style.animation = `fall ${duration}s linear infinite`;
                
                document.body.appendChild(snowflake);
            }
            
            // Ustvari lučke
            for (let i = 0; i < 15; i++) {
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
    <title>Naročila - Prodajalec</title>
</head>
<body>
    <h1>📦 Moja naročila kot prodajalec</h1>
    
    <div class="nav-links">
        ✨ <a href="<?= BASE_URL . "karte" ?>">Vse karte</a> ✨ |
        ✨ <a href="<?= BASE_URL . "store" ?>">Prodajalna</a> ✨ |
        ✨ <a href="<?= BASE_URL . "orders/my" ?>">Moja naročila (kot kupec)</a> ✨
    </div>
    
    <?php if ($_SESSION["vloga"] == "SELLER"): ?>
        <table class="orders-table">
            <tr>
                <th>🔢 ID naročila</th>
                <th>👤 Kupec</th>
                <th>📅 Datum</th>
                <th>💰 Znesek</th>
                <th>📊 Status</th>
                <th>🏪 Prodajalec</th>
                <th>🔍 Postavke</th>
            </tr>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td>#<?= $order["id"] ?></td>
                    <td>
                        <?= htmlspecialchars(isset($order["buyer_name"]) ? $order["buyer_name"] : 'N/A') ?> 
                        <?= htmlspecialchars(isset($order["buyer_surname"]) ? $order["buyer_surname"] : '') ?>
                    </td>
                    <td><?= $order["order_date"] ?></td>
                    <td><strong><?= number_format($order["total_amount"], 2) ?> €</strong></td>
                    <td>
                        <span class="status-badge status-<?= htmlspecialchars($order["status"]) ?>">
                            <?php 
                            $status_text = '';
                            switch($order["status"]) {
                                case 'pending': $status_text = 'Čaka'; break;
                                case 'confirmed': $status_text = 'Potrjeno'; break;
                                case 'cancelled': $status_text = 'Preklicano'; break;
                                case 'refunded': $status_text = 'Stornirano'; break;
                                default: $status_text = $order["status"];
                            }
                            echo $status_text;
                            ?>
                        </span>
                    </td>
                    <td class="seller-info">
                        <strong><?= htmlspecialchars($order["seller_email"]) ?></strong><br>
                        <?= htmlspecialchars(isset($order["seller_name"]) ? $order["seller_name"] : '') ?> 
                        <?= htmlspecialchars(isset($order["seller_surname"]) ? $order["seller_surname"] : '') ?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL . "orders/details/" . $order["id"] ?>">
                            👁️ Prikaži
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="access-denied">
            <h2 style="color: var(--gold); margin-top: 0;">🚫 Dostop zavrnjen</h2>
            <p>Nimate dostopa do te strani. Samo prodajalci lahko vidijo naročila.</p>
            <p style="margin-top: 20px;">
                <a href="<?= BASE_URL . "store" ?>" style="color: var(--gold); text-decoration: underline;">
                    🏪 Nazaj v prodajalno
                </a>
            </p>
        </div>
    <?php endif; ?>
    
    <div class="footer-decoration">
        🎅🎄✨📦🦌🔔
    </div>
</body>
</html>