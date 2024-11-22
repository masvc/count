<?php
// count.dat:
// .dat は「データ」の略であり、通常はバイナリデータや構造化されたデータ（例えば、特定のフォーマットで保存された数値や文字列）を格納するために使用されます。
// .dat ファイルは、人間が直接読み書きできる形式ではなく、特定のアプリケーションやプログラムによって読み取られることが多いです。

$fp = fopen('count.dat', 'r+b');

flock($fp, LOCK_EX);

$count = fgets($fp);

$count++;
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HPの人数をカウントするアクセスカウンター</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
        }

        span {
            font-weight: bold;
            font-size: 30px;
            margin: 0 5px;

        }

        div {
            background-color: black;
            color: white;
            width: 300px;
            padding: 20px;
            margin: 10px;
        }

        h1 {
            font-size: 12px;
            color: gray;
        }
    </style>

</head>

<body>
    <main>
        <h1>アクセスカウンターサンプル：</h1>

        <div>
            <p>あなたは<span><?php echo $count; ?>人目</span>のお客様です</p>
        </div>
    </main>
</body>

</html>

<?php
// 「count.dat」にファイルを書き込む前に「rewind」でポインターをファイルの先頭に戻さないと、増加したアクセス数は元の数字の後ろに追記されていく形となります。
// つまりアクセスがあるたびに「0」→「01」→「012」→「01213」→「012131214」という風に「count.dat」に書き込まれることとなりアクセス数の表示が滅茶苦茶になります。
// 「rewind」 でポインターをファイルの先頭に戻しておくと、そのようなことも無くなります。
rewind($fp);

fwrite($fp, $count);

flock($fp, LOCK_UN);

fclose($fp);
?>