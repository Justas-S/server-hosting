
<div class="container">
    <p>Serverio adresas: {{ $gameserver->ip }}</p>
    <p>MySQL duomenų bazė: {{ $database->name }}</p>
    <p>MySQL vartotojas: {{ $db_user->username }}</p>
    <p>MySQL slaptažodis: {{ $db_user->password }}</p>
    <p>FTP vartotojas: {{ $ftp_user->username }}</p>
    <p>FTP slaptažodis: {{ $ftp_user->password }}</p>
</div>