<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Font-Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>


<header>
	<h1>システム管理画面</h1>
</header>


<p></p>
<?php


//左先頭文字1byteから26byteは変更不可とする。26は256-230/
//レコード最大数（制御レコード含む）レコード最大数は変更可 2以上99999以下とする/
//あまり大きいとみずらいので1000程度がいいかも/
define('MAX_RECORDNUM'    , '10');


//レコードバイト数は１レコード256BYTEの固定長とする、/
//コメント欄バイト数（サイズ変更可）「sqlだと長いので1024位か？」/
define('MESSAGE_BYTE'     , '30');


//制御レコード（１レコード）の文字埋め（初期化時）文字種変更可/
define('MESSAGE_CHAR_HEAD', '+');

//データレコード（２レコード以降）の文字埋め（初期化時）文字種変更可/
define('MESSAGE_CHAR_DATA', ' ');

//改行文字/
define('CRLF', "<br>"."\n");


//ON：1 OFF:0/
define('ON' ,'1');
define('OFF','0');

//関数戻り値/
define('RTN_OK','0');
define('RTN_NG','-1');


//TEST MODEの場合は1(ON) 当関数がコール時された直後、ファイルをDELETEし再作成する。そのため、運用時はOFFでよい/
define('TEST_MODE_ON'     , '1');
define('TEST_MODE_OFF'    , '0');




//ファイル名（ファイル名は変更可）/
define('LOG_FILENAME'    ,'./Log_Csv_Wrt.txt');

//ファイル OPEN モード a:追加）/
define('FILE_APPEND_MODE'  , "a" );
define('FILE_READ_MODE'    , "r" );
define('FILE_REWRITE_MODE' , "r+");


//ファイル関連のエラー/
define('OPEN_NG_MSG',    'OPEN ERROR');
define('WRT_OK_MSG',     '正常終了');
define('WRT_NG_MSG',     'WRITE ERROR');
define('SEEK_NG_MSG',    'SEEK ERROR');
define('FGET_NG_MSG',    'FGET ERROR');
define('UNLINK_NG_MSG',  'UNLINK ERROR');

define('FUNCTION_NAME',  'Log_CsvTxt_Wrt()');

//その他のエラー/
define('MSG_LNGS_OVER',  'コメントが最大BYTEを超えています');


//------------------------------------/
//関数 Log_CsvTxt_Wrt/
//------------------------------------/
//当関数は指定したテキストファイルに引数で受け取った文字列(str)を１レコード分書き込む./
//・作成ファイルはTXT　CSV形式とする。/
//・１レコード長は256BYTEとする。MESSAGE_BYTEを変更することは可能である。/
//・当ファイルはサイクリックファイルである。１レコード目に最初の５バイト分に/
//  最後に書き込んだレコード番号を設定している。運用時のファイルの肥大化を防ぐ。/
//・DBエラーなどDBにアクセスできないときや、log情報、ERROR情報を蓄積する/
//・LOG_FILENAMEで指定したファイルが存在しない場合は新規作成する。/
//------------------------------------/
//ファイルフォーマット/
//1 書き込み済みレコード番号	5Byte  00000　5byteなので最大99999レコード。/
//2 カンマ										1Byte CSV対応の為/
//3 書き込み日時							19Byte YYYY/MM/DD HH:MM:SS /
//4 カンマ										1Byte CSV対応の為/
//  制御部　26byte/
//5 文字列										MESSAGE_BYTE(define 230 Byte) /
//------------------------------------/
//引数： 1. char $str :書き込む文字列/
//------------------------------------/
//戻値： OK int  1:正常終了/
//       NG int  -1:ファイルアクセスエラー/

//------------------------------------/


//function Log_CsvTxt_Wrt($str)
//{

		//システムエラーを表示しない/
		ini_set('display_errors', OFF);
		
		//エラーメッセ―ジ初期化/
		$err_msg = WRT_OK_MSG;
		
		//テストモード（通常はTEST_MODE_OFFの "0"）/
		$testmode = TEST_MODE_OFF;

		//ファイル名設定/
		$file = LOG_FILENAME;
		
		if($testmode == TEST_MODE_ON)
		{
			//過去のファイルを削除する/
			$del = unlink($file);
			if($del == false)
			{
				//unlink ERROR　存在しない場合　不要だと思うが一応念のためメッセージ出力/
				$err_msg = Error_Data_edit(__LINE__, UNLINK_NG_MSG, LOG_FILENAME.'削除に失敗しましたが、処理を続行します');
				echo $err_msg.CRLF;
				ini_set('display_errors', OFF);
			}
		}
		

		
		
		//FILE OPEN r+モード （ファイルの存在を確認する）/
		$fp = fopen($file, FILE_READ_MODE);
		if ($fp == false) 
		{
			//ファイルが存在しない場合、MAX_RECORDNUM数分を既定データで作成する。/
			//制御レコード（１レコード目）作成追加処理
			$fp0 = fopen($file, FILE_APPEND_MODE);
			if ($fp0 == false) 
			{
				//OPEN ERROR/
				$err_msg = Error_Data_edit(__LINE__, OPEN_NG_MSG, 'OPENに失敗しました');
				echo $err_msg.CRLF;
				return RTN_NG;
			}
			
			//制御レコード１行編集/
			$line  = "00001" . "," . date("Y/m/d H:i:s");
			$line .= "," . str_repeat(MESSAGE_CHAR_HEAD, MESSAGE_BYTE);
			$line .= "\n";
			
			//更新(追加）処理/
			$wrt_err=fwrite($fp0, $line);
			if($wrt_err == false)
			{
				//WRITE error/
				$err_msg = Error_Data_edit(__LINE__, WRT_NG_MSG, '1行目の書き込みに失敗しました');
				echo $err_msg.CRLF;
				
				//FILE CLOSE/
				fclose($fp0);
				return RTN_NG;
			}
			
			
			//FILE CLOSE/
			fclose($fp0);
				
				
			// ＊＊＊＊＊＊データレコード（２レコード目以降）既定データで作成する/
			//FILE OPEN aモード/
			$fp2   =  fopen($file, FILE_APPEND_MODE);
			if ($fp2 == false) 
			{
				//OPEN ERROR/
				$err_msg = Error_Data_edit(__LINE__, OPEN_NG_MSG, 'OPENに失敗しました');
				echo $err_msg.CRLF;
				
				return RTN_NG;
			}

			for($i=0; $i< MAX_RECORDNUM-1; $i++)
			{
			
				//データレコード編集処理/
				$line  =  sprintf("%05d", $i+2). ",". date("Y/m/d H:i:s").",";
				$line .=  str_repeat(MESSAGE_CHAR_DATA, MESSAGE_BYTE) ."\n";
	
				
				//更新(追加）処理/
				$wrt_err=fwrite($fp2, $line);
				if($wrt_err == false)
				{
					//WRITE ERRORの場合/
					
					$err_msg = Error_Data_edit(__LINE__, SEEK_NG_MSG, sprintf("%d", $i+2)."行目の書き込みに失敗しました");
					echo $err_msg.CRLF;
					
					//FILE CLOSE/
					fclose($fp2);
					return RTN_NG;
				}		
			}
			//FILE CLOSE/
			fclose($fp2);
		}
		else
		{
			//存在確認用のOPENをクローズ/
			fclose($fp);
		}
		
		//指定ファイル存在確認完了/


		//これ以降のPGが通常/
		//OPEN fp1/
		$fp1        = fopen($file, FILE_REWRITE_MODE);
		if ($fp1 == false) 
		{
			//OPEN ERROR/
			$err_msg = Error_Data_edit(__LINE__, OPEN_NG_MSG, 'OPENに失敗しました');
			echo $err_msg.CRLF;
			
			return RTN_NG;
		}
		//1レコード目読み込み、指定のレコード番号獲得/
		//1行読み込み/
		$line       = fgets($fp1);
		if($line == false)
		{
			$err_msg = Error_Data_edit(__LINE__, FGET_NG_MSG, 'FGET(READ)に失敗しました');
			echo $err_msg.CRLF;
			
			//FILE CLOSE/
			fclose($fp1);
			return RTN_NG;
		}
		
		
		//SEEKポイントで利用するためレコード長を取得/
		$recordbyte = strlen($line);
		
		//現在の書き込みレコード番号を取得/
		$now_no     = substr($line, 0, 5);
		//書き込むレコード番号を獲得する ＋１する/
		$wr_rcdnum = intval($now_no) + 1;
		
		
		//1レコード目 番号書き込み処理START １レコード目なのでポインタを初期化（SEEK_SET）/
		$seek_error = fseek($fp1, 0, SEEK_SET);
		if($seek_error == -1)
		{
			//SEEK ERROR/
			$err_msg = Error_Data_edit(__LINE__, SEEK_NG_MSG, 'SEEKに失敗しました');
			echo $err_msg.CRLF;
			
			//FILE CLOSE/
			fclose($fp1);
			return RTN_NG;
		}
		
		
		//書き込みデータセット 前回の書き込みレコードが最大レコード（MAX_RECORDNUM）になっているか/
		if($wr_rcdnum > MAX_RECORDNUM)
		{
			//最大レコード数に達した場合、2レコード目の書き込みとする/
			$wr_rcdnum = 2;
			$wr_no1  = sprintf("%05d", $wr_rcdnum);
		}
		else
		{
			$wr_no1  = sprintf("%05d", $wr_rcdnum);
		}
			
		//制御レコード編集処理/
		$line     = $wr_no1 . "," . date("Y/m/d H:i:s");
		$line    .= "," . str_repeat(MESSAGE_CHAR_HEAD, MESSAGE_BYTE);
		$line    .= "\n";

		//制御レコード（１レコード目）の書き込み処理/
		$wrt_err=fwrite($fp1, $line);
		if($wrt_err == false)
		{
			//WRITE ERROR/
			$err_msg = Error_Data_edit(__LINE__, WRT_NG_MSG, '1行目の書き込みに失敗しました');
			echo $err_msg.CRLF;
			
			//FILE CLOSE/
			fclose($fp1);
			return RTN_NG;
		}

		//FILE CLOSE/
		fclose($fp1);
		//制御レコード（1レコード目） 番号書き込み終了！！*********************/
		
		
		
		//データレコード（2レコード以降） 番号書き込みSTART*************/
		//データ部の更新内容　引数で受け取ったメッセージ文字列確認/
		$message = $str;

		//メッセージの文字列長確認/
		$len = strlen($message);
		if($len > MESSAGE_BYTE)
		{
			$err_msg = Error_Data_edit(__LINE__, MSG_LNGS_OVER, '最大は'.MESSAGE_BYTE ."BYTE 、処理を続行します");
			echo $err_msg .CRLF;
			//全角文字もあるので/
			$message = mb_substr($str, 0 , MESSAGE_BYTE/2);
			echo $message .CRLF;
			ini_set('display_errors', OFF);
		}
		
		
		//ファイルOPEN fp2/
		$fp2     = fopen($file, FILE_REWRITE_MODE);
		if ($fp2 == false) 
		{
			$err_msg = Error_Data_edit(__LINE__, OPEN_NG_MSG, 'OPENに失敗しました');
			echo $err_msg.CRLF;
			return RTN_NG;
		}
		
		//ファイルポインタを０にする。/
		$seek_error = fseek($fp2, 0, SEEK_SET);
		if($seek_error == -1)
		{
			
			$err_msg = Error_Data_edit(__LINE__, SEEK_NG_MSG, 'SEEKに失敗しました.pointerを初期化できません');
			echo $err_msg.CRLF;
			
			//FILE CLOSE/
			fclose($fp2);
			return RTN_NG;
		}
			
		//ファイルポインタを指定の書き込み位置に設定する。/
		$seek_error = fseek($fp2, $recordbyte * ($wr_rcdnum - 1) , SEEK_SET);
		if($seek_error == -1)
		{
			$err_msg = Error_Data_edit(__LINE__, SEEK_NG_MSG, 'SEEKに失敗しました');
			echo $err_msg.CRLF;
			
			//FILE CLOSE/
			fclose($fp2);
			return RTN_NG;
		}
			
		//書き込みデータセット/
		$line  = sprintf("%05d", $wr_rcdnum) . "," . date("Y/m/d H:i:s");
		$line .= "," . $message ;

		//2レコード目以降の書き込み処理/
		$wrt_err= fwrite($fp2, $line);
		if($wrt_err == false)
		{
			$err_msg = Error_Data_edit(__LINE__, SEEK_NG_MSG, sprintf("%d", $wr_rcdnum)."行目の書き込みに失敗しました");
			echo $err_msg.CRLF;
			
			//FILE CLOSE/
			fclose($fp2);
			return RTN_NG;
		}
			
		
		fclose($fp2);
		//データレコード番号書き込み終了！！END/

	
		header("Location: index.html");
		return RTN_OK;
///}	
		

	
	# Content-type を出力
	header("Content-type:text/plain");
	# 文字列を出力
//	echo $err_msg;/
?>

<?php
function Error_Data_edit($lineno,$msg1, $msg2)
{


	ini_set('display_errors', ON);
	
	$err_msg = '関数名 '. FUNCTION_NAME .' ';
	$err_msg .= $lineno . '行目 ';
	$err_msg .= $msg1 . ' ';
	$err_msg .= LOG_FILENAME . ' ' . $msg2;
	
	
	return $err_msg;
	

}

?>



</body>
</html>