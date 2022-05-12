
<style>.navbar-brand
{
    position: absolute;
    width: 100%;
    left: 0;
    text-align: center;
    margin:0 auto;
}
.navbar-toggle {
    z-index:3;
}</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">TV REDE MINAS</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href=".">SAIR <span class="glyphicon glyphicon-off"></span><span class="sr-only">(current)</span></a></li>
      </ul>
      <?php
        if(preg_match('/geraVoucher/i', $_SERVER['REQUEST_URI'])){
      ?>
      <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="./Cadastro">Gerar Outro Voucher <span class="sr-only">(current)</span></a></li>
      </ul>
      <?php
        }
      ?>
    </div>
  </div>
</nav>


