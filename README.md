# symfony_CRUD
Simple full-stack Blog web-app using PHP, html, css, mySQL, composer. 

/simple-crud
│── /app
│   ├── /Controllers
│   │   ├── BlogController.php
│   │   ├── AuthController.php
│   │   ├── CommentController.php
│   │   └── BaseController.php
│   ├── /Models
│   │   ├── Blog.php
│   │   ├── User.php
│   │   ├── Comment.php
│   └── /Views
│       ├── layout.php
│       ├── home.php
│       ├── post.php
│       ├── login.php
│       ├── register.php
│── /config
│   ├── database.php
│── /public
│   ├── /css
│   ├── /js
│   └── index.php  (entry point)
│── /routes
│   ├── web.php
│── /storage
│   ├── posts.json
│── /vendor
│── .env
│── .gitignore
│── composer.json
│── README.md


# Requirements :
Iepriekšējais uzdevums, kuru apraksts atrodas šajās lekcijās:
13.12.2024
 Funkcijas: scandir().
8. Faila pārvietošana vai pārdēvēšana
 Uzdevums: Pārvietot failu no temp/data.txt uz archive/data.txt.
 Funkcijas: rename().
9. Faila izmēra iegūšana
 Uzdevums: Noteikt faila image.jpg izmēru baitos.
 Funkcijas: filesize().
10. Faila pēdējās modifikācijas laika iegūšana
 Uzdevums: Parādīt faila config.php pēdējo modificēšanas datumu un laiku.
 Funkcijas: filemtime().
13.12.2024 (5) – Faili, OOP
[10:05] Jānis Strauts: Pieslēgšanās un Reģistrēšanās formas jums jau ir izveidotas. Tas
bija jau viens no iepriekšējiem uzdevumiem.
[10:06] Jānis Strauts: Jāpievieno funkcionalitāte, ka Reģistrācijas dati glabājās failā.
[10:06] Jānis Strauts: Attiecīgi pieslēdzoties mēs pārbaudam vai tāds lietotājs eksistē
[10:07] Jānis Strauts: failā
[10:07] Jānis Strauts: Izmantojam OOP pieeju
[10:07] Jānis Strauts: Varam veidot vienu klasi vai vairākas
[10:08] Jānis Strauts: Ja veidojam vienu, tad visticamāk jums būs metodes, kas attiecas
uz reģistrāciju un pieslēgšanos, kā arī kļūdu pārbaudēm paredzētas metodes.
[10:09] Jānis Strauts: Ļoti praktisks un vienkārš uzdevums
[10:10] Jānis Strauts: Vai ir kādi jautājumi?
[10:10] Jānis Strauts: Kļūdu paziņojumi jāizvada pie formām
[10:11] Jānis Strauts: Datu saglabāšanai varam izmantot csv failus
[10:12] Jānis Strauts: izmantojot piem. fputcsv() un fgetcsv()
[10:13] Janis: Tas OOP kases mes tassam kā admins/lietotājs ?
[10:14] Jānis Strauts: Šis uzdevums ļoti iespējams vēlāk būs vel jāpapildina un kādā brīdi
varu palūgt atrādīt.
[10:16] Jānis Strauts: To kā klases nosaucam paliek jūsu ziņā
[10:16] Jānis Strauts: Vēlams gan izmantot angļu nosaukumus
[10:18] Jānis Strauts: Kā jau rakstīju visu šo funkcionalitāti varam realizēt vienā klasē,
bet varam veidot arī vairākas. Piem. Register, Login, Validate.
16.12.2024
16.12.2024 (1) - Faili, OOP
[10:06] Jānis Strauts: Šodienas izaicinājums ir papildināt iepriekš izveidoto reģistrēšanās
mehānismu ar iespēju izveidot un dzēst tēmas.
[10:08] Jānis Strauts: Tātad pieslēdzoties jums jāizveido iespēju izveidot jaunu tēmu. Piem. "Kā
pagatavot lasi".
[10:09] Jānis Strauts: Savas tēmas ir jāspēj arī izdzēst, bet nevar izdzēst kāda cita izveidotu tēmu.
[10:09] Jānis Strauts: Visas tēmas var redzēt visi
[10:10] Jānis Strauts: arī tie kas nav pieslēgušies vai reģistrējušies
[10:11] Jānis Strauts: Informāciju glabājam teksta failā
[10:13] Jānis Strauts: Cenšamies protams izmantot OOP pieeju.
[10:13] Janis: tas sanák kautkáds foruma tips cik saprotu
[10:14] Jānis Strauts: Jā, tikai pagaidām bez komentāru pievienošanas
[10:17] Jānis Strauts: Veidojot lietotāju piešķiram tam kaut kādu unikālu identifikātoru, tā pat
daram arī ar tēmu izveidi.
[10:17] Jānis Strauts: failā saglabājam arī izveides datumu

18.12.2024 (3) / 19.12.2024 (4)
Iesākto projektu no 13.12.2024 un 16.12.2024 papildināt ar iespēju pievienot komentāru
izveidotajai tēmai. Komentāra autors komentāru var arī izdzēst. Failus organizējam, ka katrai
tēmai ir savs komentāru failiņš.
18.12.2024 / 19.12.2024
Jāpapildina ar iespēju datus glabāt un nolasīt no MySQL datubāzes izmantojot PDO.
Iepriekšējā funkcionalitāte ir jāsaglabā – jābūt parametram ar kuru būtu viegli pārslēgties no
saglabāšanas/nolasīšanas metodes (faili vai DB).
Visus parametrus glabājam ‘.env’ failiņā. (45 teorijas lekcija) .
