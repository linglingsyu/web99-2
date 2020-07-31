<fieldset>
  <legend>目前位置：首頁　>　問券調查</legend>
  <table>
    <tr class="ct">
      <td>編號</td>
      <td>問券題目</td>
      <td>投票總數</td>
      <td>結果</td>
      <td>狀態</td>
    </tr>
    <?php

    $db = new DB("que");
    $rows = $db->all(["parent"=>0]);
    foreach($rows as $key => $row){

    ?>
    <tr class="ct">
      <td><?= $key+1 ?></td>
      <td style="text-align:left;"><?= $row['text'] ?></td>
      <td><?= $row['count'] ?></td>
      <td><a href="?do=result&q=<?= $row['id'] ?>">結果</a></td>
      <td>
          <?php
              if(empty($_SESSION['login'])){
                echo "請先登入";
              }else{
                echo "<a href='?do=vote&q=". $row['id'] ."'>參與投票</a>";
              }
          ?>
      </td>
    </tr>

    <?php
     
    }
    ?>
  </table>
</fieldset>