<fieldset style="margin:auto;padding:10px;width:50%">
  <legend>會員登入</legend>
  <table>
    <tr>
      <td class="clo" style="width:50%;">帳號</td>
      <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
      <td class="clo" style="width:50%;">密碼</td>
      <td><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
      <td><input type="button" value="登入" onclick="login()"><input type="reset" value="清除"></td>
      <td><a href="?do=forget">忘記密碼</a> | <a href="?do=reg">尚未註冊</a></td>
    </tr>
  </table>
  </fieldset>


  <script>
    //按下登入按鈕時，到資料庫找有沒有這筆帳號密碼資料
    function login(){
      //利用Jq來取acc這個變數的值 =  document.querySelector("#acc").value 
      let acc = $("#acc").val();
      let pw = $("#pw").val();
      if(acc=="" || pw==""){
        alert("帳號及密碼欄位不可為空白");
      }else{
        //兩欄都有值 送去後台做檢查
        $.get("api/chk_acc.php",{acc},function(res){

          if(res === "1"){
            //有此帳號，檢查密碼
            $.get("api/chk_pw.php",{acc,pw},function(res){
              if(res === "1"){
                //帳號密碼正確，回主頁
                if(res === "admin"){
                  location.href="admin.php";
                }else{
                  location.href="index.php";
                }
              }else{
                //帳號密碼不相符
                alert("密碼錯誤");
                location.reload();
              }
            })
          }else{
            //無此帳號
            alert("查無帳號");
            location.reload();
          }
        })
      }
}


  </script>



