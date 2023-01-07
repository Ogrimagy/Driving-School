<?php
      $nom_bdd = "auto_ecole";
$server = "localhost"; $user = "root"; $password = "";
     if (isset($_POST['VQST'])) {
     	$connexion = new PDO("mysql:host=$server;dbname=$nom_bdd", $user, $password);
     	  $qst1=$_POST['Qst1'];
     	  $qst2=$_POST['Qst2'];
     	  $qst3=$_POST['Qst3'];
     	  $qst4=$_POST['Qst4'];
     	  $qst5=$_POST['Qst5'];
     	  $qst6=$_POST['Qst6'];
     	  $qst7=$_POST['Qst7'];
     	  $qst8=$_POST['Qst8'];
     	  $qst9=$_POST['Qst9'];
          $qst10=$_POST['Qst10'];

            $bnrpns1=$_POST['rps11'];          $rpns11=$_POST['rps12'];      $rpns12=$_POST['rps13'];
          $bnrpns2=$_POST['rps21'];          $rpns21=$_POST['rps22'];      $rpns22=$_POST['rps23'];
          $bnrpns3=$_POST['rps31'];          $rpns31=$_POST['rps32'];      $rpns32=$_POST['rps33'];
          $bnrpns4=$_POST['rps41'];          $rpns41=$_POST['rps42'];      $rpns42=$_POST['rps43'];
          $bnrpns5=$_POST['rps51'];          $rpns51=$_POST['rps52'];      $rpns52=$_POST['rps53'];
          $bnrpns6=$_POST['rps61'];          $rpns61=$_POST['rps62'];      $rpns62=$_POST['rps63'];
          $bnrpns7=$_POST['rps71'];          $rpns71=$_POST['rps72'];      $rpns72=$_POST['rps73'];
          $bnrpns8=$_POST['rps81'];          $rpns81=$_POST['rps82'];      $rpns82=$_POST['rps83'];
          $bnrpns9=$_POST['rps91'];          $rpns91=$_POST['rps92'];      $rpns92=$_POST['rps93'];
          $bnrpns10=$_POST['rps101'];         $rpns101=$_POST['rps102'];     $rpns102=$_POST['rps103'];

         if ($qst1!="") {
               $q="INSERT into question (id_q,text_q) values ('1','$qst1')";
                            $resultat1=$connexion->query($q);
               
               if ($bnrpns1!="") {
                     $r11="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns1','oui','1')";
                            $resultat1=$connexion->query($r11);
               }
               if ($rpns11!="") {
                    $r21="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns11','non','1')";
                            $resultat1=$connexion->query($r21);
                      
               }
               if ($rpns12!="") {
                    $r31="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns12','non','1')";
                            $resultat1=$connexion->query($r31);
               }
         }



         if ($qst2!="") {
            $q1="INSERT into question (id_q,text_q) values ('2','$qst2')";
                            $resultat2=$connexion->query($q1);


               if ($bnrpns2!="") {
                   $r12="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns2','oui','2')";
                            $resultat1=$connexion->query($r12);
               }
               if ($rpns21!="") {
                   $r22="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns21','non','2')";
                            $resultat1=$connexion->query($r22);
               }
               if ($rpns22!="") {
                    $r32="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns22','non','2')";
                            $resultat1=$connexion->query($r32);
               }            
         }


         if ($qst3!="") {
            $q2="INSERT into question (id_q,text_q) values ('3','$qst3')";
                            $resultat3=$connexion->query($q2);


               if ($bnrpns3!="") {
                  $r13="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns3','oui','3')";
                            $resultat1=$connexion->query($r13);
               }
               if ($rpns31!="") {
                   $r23="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns31','non','3')";
                            $resultat1=$connexion->query($r23);
               }
               if ($rpns32!="") {
                  $r33="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns32','non','3')";
                            $resultat1=$connexion->query($r33);
               }            
         }


         if ($qst4!="") {
           $q3="INSERT into question (id_q,text_q) values ('4','$qst4')";
                            $resultat4=$connexion->query($q3);


               if ($bnrpns4!="") {
                   $r14="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns4','oui','4')";
                            $resultat1=$connexion->query($r14);
               }
               if ($rpns41!="") {
                    $r24="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns41','non','4')";
                            $resultat1=$connexion->query($r24);
               }
               if ($rpns42!="") {
                  $r34="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns42','non','4')";
                            $resultat1=$connexion->query($r34);
               }
         }



          if ($qst5!="") {
            $q4="INSERT into question (id_q,text_q) values ('5','$qst5')";
                            $resultat5=$connexion->query($q4);


               if ($bnrpns5!="") {
                  $r15="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns5','oui','5')";
                            $resultat1=$connexion->query($r15);
               }
               if ($rpns51!="") {
                   $r25="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns51','non','5')";
                            $resultat1=$connexion->query($r25);
               }
               if ($rpns52!="") {
                   $r35="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns52','non','5')";
                            $resultat1=$connexion->query($r35);
               }
         }


          if ($qst6!="") {
             $q5="INSERT into question (id_q,text_q) values ('6','$qst6')";
                            $resultat6=$connexion->query($q5);

               if ($bnrpns6!="") {
                    $r16="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns6','oui','6')";
                            $resultat1=$connexion->query($r16);
               }
               if ($rpns61!="") {
                    $r26="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns61','non','6')";
                            $resultat1=$connexion->query($r26);
               }
               if ($rpns62!="") {
                   $r36="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns62','non','6')";
                            $resultat1=$connexion->query($r36);
               }
         }



          if ($qst7!="") {
              $q6="INSERT into question (id_q,text_q) values ('7','$qst7')";
                            $resultat7=$connexion->query($q6);

               if ($bnrpns7!="") {
                  $r17="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns7','oui','7')";
                            $resultat1=$connexion->query($r17);
               }
               if ($rpns71!="") {
                     $r27="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns71','non','7')";
                            $resultat1=$connexion->query($r27);
               }
               if ($rpns72!="") {
                   $r37="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns72','non','7')";
                            $resultat1=$connexion->query($r37);
               }
         }



          if ($qst8!="") {
              $q7="INSERT into question (id_q,text_q) values ('8','$qst8')";
                            $resultat8=$connexion->query($q7);


               if ($bnrpns8!="") {
                    $r18="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns8','oui','8')";
                            $resultat1=$connexion->query($r18);
               }
               if ($rpns81!="")  {
                  $r28="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns81','non','8')";
                            $resultat1=$connexion->query($r28);
               }
               if ($rpns82!="") {
                    $r38="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns82','non','8')";
                            $resultat1=$connexion->query($r38);
               }
         }



          if ($qst9!="") {
             $q8="INSERT into question (id_q,text_q) values ('9','$qst9')";
                            $resultat9=$connexion->query($q8);


               if ($bnrpns9!="") {
                    $r19="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns9','oui','9')";
                            $resultat1=$connexion->query($r19);
               }
               if ($rpns91!="") {
                   $r29="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns91','non','9')";
                            $resultat1=$connexion->query($r29);
               }
               if ($rpns92!="") {
                  $r39="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns92','non','9')";
                            $resultat1=$connexion->query($r39);
               }
         }


         
         if ($qst10!="") {
             $q9="INSERT into question (id_q,text_q) values ('10','$qst10')";
                 $resultat10=$connexion->query($q9);


               if ($bnrpns10!="") {
                     $r110="INSERT INTO reponse (text_r,juste,id_q) values ('$bnrpns10','oui','10')";
                            $resultat1=$connexion->query($r110); 
               }
               if ($rpns101!="") {
                     $r210="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns101','non','10')";
                            $resultat1=$connexion->query($r210);
               }
               if ($rpns102!="") {
                   $r310="INSERT INTO reponse (text_r,juste,id_q) values ('$rpns102','non','10')";
                            $resultat1=$connexion->query($r310);
               }
         }




     	  
     	
     	  
     	  ////////////////////// entrer les QSTs //////////////////////////////////////////////////
     	                
                        
                        
                        
                       
                       
                       
                       
                       
                  /////////////////////////////////////////////////////////////////////
          //////////////////////////// entrer les bonnes reponces //////////////////////////////////////////////////
                     
                       
                        
                       
                        
                      
                        
                        
                       
                            
                   ////////////////////////////////////////////////////////////////////////
           //////////////////////////// entrer les autres reponces //////////////////////////////////////////////////
                      
                        
                      
                        
                        
                       
                       
                       
                       
                       
                      
                     
                       
                      
                      
                       
                        
                      
                       
    
                   ////////////////////////////////////////////////////////////////////////
                              echo "<script>alert(\"vous avez ajouter des question et reponces\")</script>";
                            header("location:moniteur_code.php");
       } 
?>