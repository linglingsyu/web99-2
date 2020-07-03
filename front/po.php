<style>
  fieldset{
    display: inline-block;
    vertical-align: top;
    margin-top: 20px;
  }
  .item{
    display: block;
    margin: 5px 10px;
  }
</style>
<div>目前位置：首頁 > 分類網誌 > <span id="nav"></span></div>
<fieldset><legend>分類網誌</legend>
<a class="item" href="javascript:showlist(1)">健康新知 </a> 
<a class="item" href="javascript:showlist(2)">菸害防治</a> 
<a class="item" href="javascript:showlist(3)">癌症防治</a> 
<a class="item" href="javascript:showlist(4)">慢性病防治</a> 
</fieldset>

<fieldset style="width: 75%;"><legend>文章列表</legend></fieldset>


<script>
  showlist(1);
  function showlist(type){
    let nav = ["健康新知","菸害防治","癌症防治","慢性病防治"];
    $("#nav").html(nav[type-1]);
  }

</script>