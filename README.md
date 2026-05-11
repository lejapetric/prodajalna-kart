# Spletna trgovina za prodajo kart

> Celovita spletna in mobilna rešitev za prodajo vstopnic za koncerte, gledališča, športne prireditve in druge dogodke.

## O projektu

Projekt je bil izdelan kot **seminarska naloga** pri predmetu **Elektronsko poslovanje** na **Fakulteti za računalništvo in informatiko Univerze v Ljubljani**.

Cilj naloge je bil razviti **popolnoma funkcionalno spletno prodajalno** z več uporabniškimi vlogami, varnostnimi mehanizmi (SSL, hashiranje gesel) in **mobilno aplikacijo za Android**, ki prek REST API‑ja komunicira s strežnikom.

Sistem je zgrajen po **arhitekturnem vzorcu MVC** (Model–View–Controller) za boljšo preglednost, vzdrževanje in varnost.

---

## Realizirane storitve

| Vloga | Funkcionalnosti |
|-------|------------------------------|
| **Administrator** | Prijava/odjava, posodobitev lastnih atributov, ustvarjanje/aktiviranje/deaktiviranje prodajalcev, urejanje njihovih atributov. |
| **Prodajalec** | Prijava/odjava, posodobitev lastnih atributov, obdelava naročil (potrjevanje, preklic, storniranje), upravljanje artiklov (ustvarjanje, aktiviranje, deaktiviranje), upravljanje strank. |
| **Stranka** | Prijava/odjava, posodobitev atributov, nakupovanje (košarica, zaključek nakupa), pregled zgodovine naročil (oddana, potrjena, preklicana, stornirana). |
| **Anonimni uporabnik** | Pregled artiklov, registracija (prek HTTPS). |

---

## Podatkovni model

Podatkovna baza `trgovina_kart` je **normalizirana do 3. normalne oblike**. Sestavljajo jo štiri glavne tabele:

### 1. `users` – uporabniki sistema
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| name, surname | VARCHAR | Ime in priimek |
| email | VARCHAR | Edinstven e‑poštni naslov |
| password | VARCHAR | **Zgoščeno geslo (bcrypt)** – nikoli shranjeno v čisti obliki |
| address_street, address_number | VARCHAR | Naslov (ulica in hišna številka) |
| address_post, address_zip | VARCHAR | Kraj in poštna številka |
| type | ENUM | Vloga: ADMIN, SELLER, BUYER |
| aktiviran | BOOLEAN | Mehki bris – onemogoča prijavo |

> **Opomba o geslih**: Vsa uporabniška gesla so pred shranjevanjem v podatkovno bazo zgoščena s kriptografsko varnim algoritmom **bcrypt**. To pomeni, da dejanske vrednosti gesel niso nikoli shranjene v bazi – tudi v primeru nepooblaščenega dostopa do baze napadalec ne pridobi uporabniških gesel.

### 2. `karte` – artikli (vstopnice)
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| naziv | VARCHAR | Ime dogodka |
| cena | DECIMAL(10,2) | Cena vstopnice |
| aktiviran | BOOLEAN | Ali je artikel viden v trgovini |
| seller_email | VARCHAR | Tuj ključ → `users.email` (prodajalec) |
| user_id | INT | Tuj ključ → `users.id` |

### 3. `orders` – naročila
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| user_id | INT | Tuj ključ → `users.id` (kupec) |
| order_date | DATETIME | Datum naročila |
| total_amount | DECIMAL(10,2) | Skupni znesek |
| status | ENUM | confirmed, cancelled, refunded |
| shipping_address | VARCHAR | Naslov za dostavo |
| seller_email | VARCHAR | Tuj ključ → `users.email` (prodajalec) |

### 4. `order_items` – postavke naročila
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| order_id | INT | Tuj ključ → `orders.id` |
| karta_id | INT | Tuj ključ → `karte.id` |
| quantity | INT | Količina |
| price | DECIMAL(10,2) | Cena ob nakupu (zgodovinski podatek) |
| seller_email | VARCHAR | Tuj ključ → `users.email` |

---

## Varnost sistema

| Področje | Implementirani mehanizmi |
|----------|--------------------------|
| **Avtentikacija** | Uporabniško ime + geslo (avtentikacija poteka prek standardne prijave) |
| **Avtorizacija** | RBAC (Role‑Based Access Control) – strogo ločene pravice po vlogah |
| **Hramba gesel** | **bcrypt hashiranje** – gesla se nikoli ne shranjujejo v čisti obliki |
| **Komunikacija** | Izključno HTTPS (SSL/TLS) – šifriran prenos podatkov |
| **Zaščita pred napadi** | Pripravljene poizvedbe (SQL injection), filtriranje/escaping (XSS), validacija vnosov (strežnik+odjemalec) |
| **Mehki bris** | `aktiviran` stolpec – podatki ostanejo, vendar so neaktivni |

---

## Testni uporabniki

### Administrator
| Ime | Priimek | Email | Geslo | Vloga |
|-----|---------|-------|-------|-------|
| Admin | Admin | admin@karte.si | Admin123! | ADMIN |

### Prodajalci (SELLER)
| Ime | Priimek | Email | Geslo | Aktiviran |
|-----|---------|-------|-------|-----------|
| Tomaz | Tomazin | tomaz@karte.si | TomazTomazin1! | ✅ |
| Vanja | Venko | vanja@karte.si | VanjaVenko1! | ✅ |
| Branko | Bernard | branko@karte.si | BrankoBernard1! | ❌ |
| Katja | Klopcic | katja@karte.si | KatjaKlopcic1! | ✅ |
| Peter | Novak | peter@karte.si | PeterNovak1! | ✅ |
| Hana | Horvat | hana@karte.si | HanaHorvat1! | ✅ |
| Aljaz | Soklic | aljaz@karte.si | AljazSoklic1! | ✅ |

### Kupci (BUYER)
| Ime | Priimek | Email | Geslo | Aktiviran |
|-----|---------|-------|-------|-----------|
| Zori | Zoran | zori@karte.si | ZoriZoran1! | ✅ |
| Neza | Novak | neza@karte.si | NezaNovak1! | ✅ |
| Ana | Anič | ana@karte.si | AnaAnič1! | ❌ |
| Miha | Novak | miha@karte.si | MihaNovak1! | ✅ |
| Spela | Susnik | spela@karte.si | SpelaSusnik1! | ✅ |

> **Opomba:** Uporabniki z `aktiviran = 0` se ne morejo prijaviti v sistem.

---

## Mobilna aplikacija (Android)

Projekt vključuje **funkcionalno Android aplikacijo**, razvito v **Android Studiu** (Java), ki prek REST API‑ja komunicira s spletno trgovino.

### Implementirane funkcionalnosti
- Prijava in odjava uporabnikov
- Brskanje po artiklih

Aplikacija se poganja v **Android emulatorju** ali na fizični napravi in se realno povezuje s spletno trgovino.

---

## Tehnologije

### Spletni del
| Komponenta | Tehnologija |
|------------|-------------|
| Backend | PHP (MVC arhitektura) |
| Podatkovna baza | MySQL |
| Spletni strežnik | Apache |
| Frontend | HTML, CSS, JavaScript, AJAX |
| Komunikacija | HTTPS (SSL/TLS) |
| Varnost gesel | bcrypt |

### Mobilni del (Android)
| Komponenta | Tehnologija |
|------------|-------------|
| Razvojno okolje | Android Studio |
| Programski jezik | Java |
| API komunikacija | REST API (JSON) |
| Testiranje | Android Emulator / fizična naprava |

---

## Namestitev in zagon

### Zahteve
- Apache strežnik (XAMPP / WAMP / LAMP)
- PHP 7.4+
- MySQL 5.7+
- Android Studio (za mobilni del)

### Koraki za spletni del

1. **Klonirajte repozitorij:**
   ```bash
   git clone <repository-url>
   ```

2. **Uvozite podatkovno bazo:**
   ```bash
   mysql -u root -p < baza.sql
   ```
   (ali prek phpMyAdmin – uvozite datoteko `baza.sql`)

3. **Konfigurirajte povezavo z bazo:**
   - Uredite datoteko `config/db.php`
   - Nastavite ustrezne podatke za gostitelj, uporabniško ime, geslo in ime baze

4. **Postavite projekt v Apachejev `htdocs`** (XAMPP) ali ustrezno mapo

5. **Odprite brskalnik** na: `https://localhost/trgovina_kart`

> **Opomba:** Za pravilno delovanje HTTPS je potrebna ustrezna konfiguracija SSL na Apache strežniku.

### Koraki za Android aplikacijo

1. Odprite projekt v **Android Studiu**
2. Nastavite URL naslov strežnika v kodi:
   - Za emulator: `https://10.0.2.2/trgovina_kart`
   - Za fizično napravo: `https://<vaš-IP-naslov>/trgovina_kart`
3. Zaženite aplikacijo v **Android emulatorju** ali na fizični napravi
4. Prijavite se s testnim uporabnikom (npr. `zori@karte.si` / `ZoriZoran1!`)

---

## Avtorica

**Leja Petrič**  
Fakulteta za računalništvo in informatiko (UNI), 
Univerza v Ljubljani  

---

## Literatura

1. Yank K. *Build Your Own Database-Driven Website Using PHP & MySQL*. SitePoint, 2003.
2. Michele D.; Jon P. *Learning PHP and MySQL*. O'Reilly, 2006.
3. Tim C.; Joyce P.; Clark M. *PHP5 and MySQL Bible*. Wiley Publishing, Inc., 2004.
4. Red Hat Software inc. *Linux Complete Command Reference*. Sams Publishing, 1997.

