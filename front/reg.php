<?php

?>

<fieldset style="margin:auto;padding:10px;width:50%">
  <legend>會員註冊</legend>
  <!-- 要加入from，否則reset不會有作用 -->
  <form>
  <table>
    <h2 style="color:red;font-size:18px">*請設定你要註冊的帳號及密碼(最長12個字元)</h2>
    <tr>
      <td class="clo" style="font-size:14px">Step1.登入帳號</td>
      <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
      <td class="clo" style="font-size:14px">Step2.登入密碼</td>
      <td><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
      <td class="clo" style="font-size:14px">Step3.再次確認密碼</td>
      <td><input type="password" name="pw2" id="pw2"></td>
    </tr>
    <tr>
      <td class="clo" style="font-size:14px">Step4.信箱(忘記密碼時使用)</td>
      <td><input type="email" name="email" id="email"></td>
    </tr>
    <tr>
      <td><input type="button" value="註冊" onclick="login()"><input type="reset" value="清除"></td>
      <td></td>
    </tr>
  </table>
  </form>
  </fieldset>


  <script>

/***
 * 1.先判斷空白 
 *  →有任何一個空白:出現警告訊息
 *  →沒有空白:
 *    2.判斷密碼pw==pw2:送出資料到後台做檢查→
 *        3.判斷帳號有無重複:
 *                無:寫入資料
 *                
 *     →不相等:alert("密碼錯誤)
 */

 
    function login(){
      let acc = $("#acc").val();
      let pw = $("#pw").val();
      let pw2 = $("#pw2").val();
      let email = $("#email").val();
      if(acc=="" || pw=="" || pw2=="" || email==""){
        alert("不可空白");
      }else{
        if(pw==pw2){
          $.get("api/chk_acc.php",{acc},function(res){
            if(res==='1'){
              alert("帳號重覆");
            }else{
              $.post("api/reg.php",{acc,pw,email},function(res){
                if(res === "1"){//成功
                  alert("註冊完成，歡迎加入");
                }else{ //解題時理論上不該發生 :失敗
                  alert("註冊失敗");
                }

              })
            }
          })

        }else{
          alert("密碼錯誤");
        }
      }
}


  </script>









  