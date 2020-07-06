<fieldset>
  <legend>帳號管理</legend>
  <form action="api/admin_acc.php" method="post">
  <table style="width:50%;margin:auto;">
    <tr class="ct clo">
      <td>帳號</td>
      <td>密碼</td>
      <td>刪除</td>
    </tr>
    <?php
    $db = new DB("user");
    $rows = $db->all();
    foreach ($rows as $row) {
        if($row['acc'] != "admin"){
    ?>
      <tr class="ct">
        <td><?= $row["acc"] ?></td>
        <td><?= str_repeat("*",strlen($row["pw"])) ?></td>
        <td><input type="checkbox" name="del[]" value="<?= $row['id'] ?>"></td>
      </tr>
    <?php
    }
  }
    ?>
  </table>
  <div class="ct"><input type="submit" value="確定刪除"><input type="reset" value="清空選取"></div>
  </form>


  <form style="width: 50%; margin:auto;">
  <h3>新增會員</h3>
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
      <td><input type="button" value="新增" onclick="login()"><input type="reset" value="清除"></td>
      <td></td>
    </tr>
  </table>
  </form>
</fieldset>


<script>

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
                  location.reload();
                }else{ //解題時理論上不該發生 :失敗
                  alert("註冊失敗請聯絡管理員");
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