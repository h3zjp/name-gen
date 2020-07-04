<?php

	// 項目数
	$num_sei =       "45906";
	$num_mei_man =   "54137";
	$num_mei_woman = "35765";

	if (isset($_POST['type'])) {

		// SQL設定読み込み (接続)
		require_once('config.php');

		// SQLエラーチェック
		if( mysqli_connect_errno($connect) ) {
			echo mysqli_connect_errno($connect) . ' : ' . mysqli_connect_error($connect);
		}

		// SQL文字コード設定
		mysqli_set_charset( $connect, 'utf8mb4');

		// POSTの中身を格納
		$select = $_POST['type'];

		// 10回ループ
		for ($i = 0 ; $i < 10; $i++) {

			// POSTの振り分け
			switch ($select) {

				case "man":

				// Ramdom
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_sei = mt_rand(1, $num_sei);
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_mei_man = mt_rand(1, $num_mei_man);

				// SELECT文を変数に格納
				$sql_sei = "select * from sei where id=" . $rand_sei;
				$sql_mei = "select * from mei_man where id=" . $rand_mei_man;

				// SQLを実行
				$query_sei = mysqli_query( $connect, $sql_sei);
				$query_mei = mysqli_query( $connect, $sql_mei);

				// 判定用
				$case_num = "0";

				break;

				case "woman":

				// Ramdom
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_sei = mt_rand(1, $num_sei);
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_mei_woman = mt_rand(1, $num_mei_woman);

				// SELECT文を変数に格納
				$sql_sei = "select * from sei where id=" . $rand_sei;
				$sql_mei = "select * from mei_woman where id=" . $rand_mei_woman;

				// SQLを実行
				$query_sei = mysqli_query( $connect, $sql_sei);
				$query_mei = mysqli_query( $connect, $sql_mei);

				// 判定用
				$case_num = "0";

				break;

				case "surname":

				// Ramdom
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_sei = mt_rand(1, $num_sei);

				// SELECT文を変数に格納
				$sql_sei = "select * from sei where id=" . $rand_sei;

				// SQLを実行
				$query_sei = mysqli_query( $connect, $sql_sei);

				// 判定用
				$case_num = "1";

				break;

				case "name-m":

				// Ramdom
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_mei_man = mt_rand(1, $num_mei_man);

				// SELECT文を変数に格納
				$sql_mei = "select * from mei_man where id=" . $rand_mei_man;

				// SQLを実行
				$query_mei = mysqli_query( $connect, $sql_mei);

				// 判定用
				$case_num = "2";

				break;

				case "name-w":

				// Ramdom
				mt_srand(random_int(-2**31, 2**31-1));
				$rand_mei_woman = mt_rand(1, $num_mei_woman);

				// SELECT文を変数に格納
				$sql_mei = "select * from mei_woman where id=" . $rand_mei_woman;

				// SQLを実行
				$query_mei = mysqli_query( $connect, $sql_mei);

				// 判定用
				$case_num = "2";

				break;

			}

			// 判別
			switch ($case_num) {

				case "0":

				// 結果を変数に格納
				while( $result_sei = $query_sei->fetch_array() ) {
				while( $result_mei = $query_mei->fetch_array() ) {

					$data_sei[$i][0] = $result_sei["name"];
					$data_sei[$i][1] = $result_sei["yomi"];
					$data_mei[$i][0] = $result_mei["name"];
					$data_mei[$i][1] = $result_mei["yomi"];

				}}

				break;

				case "1":

				// 結果を変数に格納
				while( $result_sei = $query_sei->fetch_array() ) {

					$data_sei[$i][0] = $result_sei["name"];
					$data_sei[$i][1] = $result_sei["yomi"];

				}

				break;

				case "2":

				// 結果を変数に格納
				while( $result_mei = $query_mei->fetch_array() ) {

					$data_mei[$i][0] = $result_mei["name"];
					$data_mei[$i][1] = $result_mei["yomi"];

				}

				break;

			}

		}

		// SQL接続を閉じる
		mysqli_close($connect);

	}

?>
<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta charset="UTF-8" />
<title>Name Generator</title>
<!-- HTML (Template) Last modified: 2020-07-04 JST Ver. 2.0.0 -->
<meta name="robots" content="none" />
<style>
@font-face {
font-family: Koruri-Regular;
src: local('Koruri-Regular'),
url('https://media.h3z.jp/fonts/Koruri-Regular.woff2') format('woff2'), 
url('https://media.h3z.jp/fonts/Koruri-Regular.woff') format('woff'),
url('https://media.h3z.jp/fonts/Koruri-Regular.ttf') format('truetype');
font-weight: 400;
font-style: normal;
font-display: swap;
}
body {
font-family: Koruri-Regular, sans-serif;
text-align: center;

}
div.result {
font-family: Koruri-Regular, sans-serif;
font-size: 2.4em;
}
ul {
list-style-type: none;
}
li {
display: inline;
}
</style>
</head>
<body>
<form action="" method="post">
	<label><input type="radio" name="type" value="man"<?php if (isset($select)) { if ($select == "man") { echo " checked"; } } ?> /><span>男性</span></label>&nbsp;
	<label><input type="radio" name="type" value="woman"<?php if (isset($select)) { if ($select == "woman") { echo " checked"; } } ?> /><span>女性</span></label>&nbsp;
	<label><input type="radio" name="type" value="surname"<?php if (isset($select)) { if ($select == "surname") { echo " checked"; } } ?> /><span>苗字のみ</span></label>&nbsp;
	<label><input type="radio" name="type" value="name-m"<?php if (isset($select)) { if ($select == "name-m") { echo " checked"; } } ?> /><span>名前のみ (男性)</span></label>&nbsp;
	<label><input type="radio" name="type" value="name-w"<?php if (isset($select)) { if ($select == "name-w") { echo " checked"; } } ?> /><span>名前のみ (女性)</span></label>&nbsp;
	<input type="submit" name="submit" value="生成!" />
</form>
<?php if (isset($_POST['type'])) {

echo'<div class="result">' . "\n";
echo"	<ul>\n";

for ($i = 0 ; $i < 10; $i++) {

if ($i == 4) {

echo'		<li><ruby>' . $data_sei[$i][0] . '<rt>' . $data_sei[$i][1] . '</rt></ruby>&emsp;<ruby>' . $data_mei[$i][0] . '<rt>' . $data_mei[$i][1] . "</rt></ruby></li>\n";
echo"	</ul>\n";

} else if ($i == 5) {

echo"	<ul>\n";
echo'		<li><ruby>' . $data_sei[$i][0] . '<rt>' . $data_sei[$i][1] . '</rt></ruby>&emsp;<ruby>' . $data_mei[$i][0] . '<rt>' . $data_mei[$i][1] . "</rt></ruby></li>\n";

} else {

echo'		<li><ruby>' . $data_sei[$i][0] . '<rt>' . $data_sei[$i][1] . '</rt></ruby>&emsp;<ruby>' . $data_mei[$i][0] . '<rt>' . $data_mei[$i][1] . "</rt></ruby></li>\n";

}}

echo"	</ul>\n";
echo"</div>\n";

} ?>
</body>
</html>