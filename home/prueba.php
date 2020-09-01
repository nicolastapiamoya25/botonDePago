<?php 
@session_start();
if (isset($_SESSION['user'])) {
    
}else{
    header('location:../index.php');
}

include_once '../includes/header.php';
?>
<br><br><br><br><br><br><br><br><br>
  <div id="app">
    <div class="content container">
      <form role="form" onsubmit="return false">
        <div class="form-group">
          <label v-for="(item, idx) in categories" class="checkbox-inline" v-bind:key="idx">
            <input type="checkbox" :value=item.id :id="item.id" :checked="item.checked" @click="check($event)">{{item.category}}
          </label>
        </div>
      </form>
    </div>
  </div>


<?php 
include_once '../includes/footer.php';
?>