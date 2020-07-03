<style>
  .all{
    display: none;
  }

  .title{
    background-color: #eee;
    cursor: pointer;
  }

</style>


<fieldset>
  <legend>目前位置：首頁 > 最新文章區 > </legend>
  <table>
    <tr>
      <td width="20%">標題</td>
      <td width="60%">內容</td>
      <td width="20%"></td>
    </tr>
    <?php
    $db = new DB("news");

    /* 分頁 */
    $total = $db->count();
    $div=5;
    $pages = ceil($total/$div);
    $now = (!empty($_GET['p']))?$_GET['p']:1 ;
    $start = ($now-1)*$div;
    $rows = $db->all([]," limit $start,$div");

    foreach ($rows as $row) {
    ?>
      <tr>
        <td class="title"><?= $row['title'] ?></td>
        <td><div class="abbr"><?= mb_substr($row['text'],0,20,'utf8') ?> ...</div>
            <div class="all"><?= nl2br($row['text']) ?></div></td>
        <td></td>
      </tr>
    <?php
    }
    ?>
  </table>
  <div class="ct">

  <?php
  if(($now-1) > 0){
    echo '<a href="?do=news&p='.($now-1).'"> < </a>';
  }

  for($i=1; $i<=$pages ; $i++){
    $fontSize = ($i == $now)? "24px":"18px";
    echo '<a href="?do=news&p='.$i.'" style="font-size:'.$fontSize.'">'.$i.'</a>';
  }

  if( ($now+1) <= $pages){
    echo '<a href="?do=news&p='.($now+1).'"> > </a>';
  }


  ?>


  </div>
</fieldset>


<script>
  $(".title").on("click",function(){
    $(this).next().children(".abbr").toggle();
    $(this).next().children(".all").toggle();
  })

</script>