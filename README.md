# Spletna trgovina za prodajo kart

> Spletna aplikacija za prodajo vstopnic za koncerte, kinematografe, muzeje in druge dogodke.

## O projektu

Projekt je bil izdelan kot seminarska naloga pri predmetu **Elektronsko poslovanje** na Fakulteti za računalništvo in informatiko Univerze v Ljubljani.

Aplikacija predstavlja funkcionalno spletno trgovino, ki omogoča:
- Ogled ponudbe kart za različne dogodke
- Dodajanje in odstranjevanje izdelkov iz nakupovalne košarice
- Prijavo, odjavo in registracijo uporabnikov
- Upravljanje naročil

Sistem je zgrajen po **MVC arhitekturnem vzorcu** za boljšo preglednost in vzdrževanje kode.

---

## Uporabniške vloge

Sistem podpira štiri tipe uporabnikov z različnimi pravicami:

| Vloga | Pravice |
|-------|---------|
| **ADMIN** | Popoln nadzor nad sistemom, upravljanje uporabnikov in kart |
| **SELLER** | Dodajanje, urejanje in aktiviranje lastnih kart za prodajo |
| **BUYER** | Brskanje po ponudbi, nakup kart, pregled naročil |
| **Anonimni uporabnik** | Ogled ponudbe, prijava/registracija |

---

## Testni uporabniki

### Gesla so sestavljena po vzorcu: `imePriimek1!`
**(prva črka imena mala, priimek z veliko začetnico, sledi `1!`)**  
Primer: Vanja Venko → `vanjaVenko1!`

### ADMIN uporabnik
| Ime | Priimek | Email | Geslo | Vloga |
|-----|---------|-------|-------|-------|
| Admin | Admin | admin@karte.si | Admin123! | ADMIN |

### Prodajalci (SELLER)

| Ime | Priimek | Email | Geslo | Aktiviran |
|-----|---------|-------|-------|-----------|
| Tomaz | Tomazin | tomaz@karte.si | tomazTomazin1! | ✅ |
| Vanja | Venko | vanja@karte.si | vanjaVenko1! | ✅ |
| Branko | Bernard | branko@karte.si | brankoBernard1! | ❌ (ni aktiviran) |
| Katja | Klopcic | katja@karte.si | katjaKlopcic1! | ✅ |
| Peter | Novak | peter@karte.si | peterNovak1! | ✅ |
| Hana | Horvat | hana@karte.si | hanaHorvat1! | ✅ |
| Aljaz | Soklic | aljaz@karte.si | aljazSoklic1! | ✅ |

### Kupci (BUYER)

| Ime | Priimek | Email | Geslo | Aktiviran | Naslov |
|-----|---------|-------|-------|-----------|---------|
| Zori | Zoran | zori@karte.si | zoriZoran1! | ✅ | Zoranova ulica 1, Ljubljana 1000 |
| Neza | Novak | neza@karte.si | nezaNovak1! | ✅ | Nezina Ulica 3, Ljubljana 1000 |
| TEST | tester | test@karte.si | testTester1! | ❌ | testerjeva 4, Ljubljana 1000 |
| Ana | Anič | ana@karte.si | anaAnič1! | ❌ | Ulica Ane 5, Ljubljana 1000 |
| Miha | Novak | miha@karte.si | mihaNovak1! | ✅ | Ulica na Balance 55, Ljubljana 1000 |
| Spela | Susnik | spela@karte.si | spelaSusnik1! | ✅ | Ulica na Balance 4, Ljubljana 1000 |

> **Opomba:** Uporabniki z `aktiviran = 0` se ne morejo prijaviti v sistem.

---

## Tehnologije

- **Backend:** PHP (MVC arhitektura)
- **Podatkovna baza:** MySQL
- **Spletni strežnik:** Apache
- **Frontend:** HTML, CSS, JavaScript
- **Komunikacija:** HTTPS

---

## Podatkovni model

Podatkovna baza `karte` je sestavljena iz štirih glavnih tabel:

### 1. `users` - Uporabniki
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| name, surname | VARCHAR | Ime in priimek |
| email | VARCHAR | E-pošta (edinstvena) |
| password | VARCHAR | Zgoščeno geslo (bcrypt) |
| address_street, address_number | VARCHAR | Ulica in hišna številka |
| address_post, address_zip | VARCHAR | Kraj in poštna številka |
| type | ENUM('ADMIN','SELLER','BUYER') | Vloga uporabnika |
| aktiviran | BOOLEAN | Ali je račun aktiviran |

### 2. `karte` - Vstopnice
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| naziv | VARCHAR | Ime dogodka/vstopnice |
| cena | DECIMAL(10,2) | Cena vstopnice |
| aktiviran | BOOLEAN | Ali je karta vidna na strani |
| seller_email | VARCHAR | Email prodajalca (tuj ključ na users.email) |
| user_id | INT | ID prodajalca (tuj ključ na users.id) |

**Primeri kart (aktiviranih):**
| ID | Naziv | Cena | Prodajalec |
|----|-------|------|------------|
| 1 | Vstopnica na koncert | 25.00 € | tomaz@karte.si |
| 12 | Joker Out Koncert | 35.00 € | peter@karte.si |
| 13 | Big Foot Mama | 17.00 € | hana@karte.si |
| 16 | Coldplay koncert | 85.00 € | tomaz@karte.si |
| 17 | Muse koncert | 75.00 € | tomaz@karte.si |
| 22 | Opera predstava | 45.00 € | katja@karte.si |
| 28 | Katy Perry Koncert VIP | 500.00 € | peter@karte.si |
| 33 | green day vstopnica | 110.00 € | peter@karte.si |

### 3. `orders` - Naročila
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| user_id | INT | ID kupca (tuj ključ → users.id) |
| order_date | DATETIME | Datum in čas naročila |
| total_amount | DECIMAL(10,2) | Skupni znesek naročila |
| status | ENUM('confirmed','cancelled','refunded') | Status naročila |
| shipping_address | VARCHAR | Naslov za dostavo |
| seller_email | VARCHAR | Email prodajalca (tuj ključ → users.email) |

**Statusi naročil:**
- `confirmed` - potrjeno (4 naročila)
- `cancelled` - preklicano (2 naročili)
- `refunded` - vračilo denarja (3 naročila)

### 4. `order_items` - Postavke naročila
| Polje | Tip | Opis |
|-------|-----|------|
| id | INT | Primarni ključ |
| order_id | INT | ID naročila (tuj ključ → orders.id) |
| karta_id | INT | ID kupljene karte (tuj ključ → karte.id) |
| quantity | INT | Količina |
| seller_email | VARCHAR | Email prodajalca |
| price | DECIMAL(10,2) | Cena ob nakupu |

---

## Primeri naročil

| ID naročila | Kupec | Datum | Skupaj | Status | Kupljene karte |
|-------------|-------|-------|--------|--------|----------------|
| 7 | Ana Anič | 2026-01-02 | 90.00 € | confirmed | Muse koncert (75€) + Športna prireditev (15€) |
| 8 | Neza Novak | 2026-01-02 | 8.00 € | confirmed | bunun kisses x4 (2€/kos) |
| 13 | Spela Susnik | 2026-01-02 | 50.00 € | confirmed | Vstopnica na koncert x2 (25€/kos) |

---

## amestitev in zagon

### Zahteve
- Apache strežnik
- PHP 7.4+
- MySQL 5.7+

### Koraki
1. Klonirajte repozitorij:
   ```bash
   git clone <repository-url>
   ```

2. Uvozite podatkovno bazo:
   ```bash
   mysql -u root -p < baza.txt
   ```

3. Konfigurirajte povezavo z bazo v `config/db.php`

4. Postavite projekt v Apachejev `htdocs` ali ustrezno mapo

5. Odprite brskalnik na `http://localhost/trgovina_kart`

---

## Struktura projekta

```
trgovina_kart/
├── config/           # Konfiguracijske datoteke
├── controllers/      # MVC krmilniki
├── models/           # MVC modeli
├── views/            # MVC pogledi
├── public/           # Javne datoteke (CSS, JS, slike)
├── sql/              # SQL skripte
└── index.php         # Vstopna točka
```

---

## Avtorica

**Leja Petrič**
Fakulteta za računalništvo in informatiko  
Univerza v Ljubljani

---

## Literatura

1. Yank K. *Build Your Own Database-Driven Website Using PHP & MySQL*. SitePoint, 2003.
2. Michele D.; Jon P. *Learning PHP and MySQL*. O'Reilly, 2006.
3. Tim C.; Joyce P.; Clark M. *PHP5 and MySQL Bible*. Wiley Publishing, Inc., 2004.
4. Red Hat Software inc. *Linux Complete Command Reference*. Sams Publishing, 1997.
```
