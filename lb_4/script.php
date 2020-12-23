<?php

if(isset($_POST['id'])){ $id =  (int) $_POST['id'];}
if(isset($_POST['answer'])){
    $vote = (int) $_POST['answer'];
}else{
    $vote = false;
}


if (file_exists("$id.dat")) {

    $ip= $_SERVER['REMOTE_ADDR']; //получаем ip адрес
    $ip_file = file_get_contents("ip$id.dat");//читаем содержимое файла ip адресов и помещаем в строку
    $ip_abbr = explode(",", $ip_file);//получаем в массив имеющиеся ip адреса

    $data = file("$id.dat");

    if ($vote) {
        //сравниваем ip с уже записанными
        foreach ($ip_abbr as $value)
            if ($ip == $value) {
                echo "<p><b> Вы уже голосовали!</b></p><a href='index.html'>Вернуться назад</a>";
                exit;

            }else{
                echo "<p><b> Спасибо! </b><br />Ваш голос учтен!<p><a href='index.html'>Вернуться назад</a>";
            }

        if ($vote) {
            $f = fopen("$id.dat", "w");
            flock($f, LOCK_EX);
            fputs($f, "$data[0]");
            for ($i = 1; $i < count($data); $i++) {
                $votes = explode("~", $data[$i]);
                if ($i == $vote) $votes[0]++;
                fputs($f, "$votes[0]~$votes[1]");
                fflush($f);
                flock($f, LOCK_UN);
            }
            fclose($f);
            //и записываем ip
            $ip_adr = fopen("ip$id.dat", "a++");
            flock($ip_adr, LOCK_EX);
            fputs($ip_adr, "$ip" . ",");
            fflush($ip_adr);
            flock($ip_adr, LOCK_UN);
            fclose($ip_adr);
        }
    }else {
        echo "<b>$data[0]</b><p>";
        for ($i = 1; $i < count($data); $i++) {
            $votes = explode("~", $data[$i]);
            echo "$votes[1]: <b>$votes[0]</b><br>";
        }
        echo "<a href='index.html'>Вернуться назад</a>";
    }
} else {
//передан id несуществующего голосования
    echo "Такого голосования не существует.";
    exit;
}
?>