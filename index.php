<?php
session_start();
include 'components/header.php';
include 'components/conexao.php';

$limpar = (isset($_POST['enviar']) ? $_POST['enviar'] : '');
$query = (isset($_SESSION['query']) ? $_SESSION['query'] : '');
if ($limpar =='3') {
  $query = '';
  $_SESSION['alerta']= '';
} else {
  $query = (isset($_SESSION['query']) ? $_SESSION['query'] : '');
}
?>

<div class="container" style="padding:20px">
  <div class="form-group">
    <h1>Cadastro cidadão</h1>   
  </div>

  <div class="form-group">
    <li>Para procurar nomes cadastrados, digite o nome no campo abaixo e clique em pesquisar</li>
    <li>Para gerar NIS, clique em gerar</li>
  </div>

  <form action="executa.php" method="post" name="frmNis">
    <div class="form-group">
      <label for="txtNome">Digite parte do nome</label>
      <input type="text" class="form-control" name="txtNome" placeholder="Digite o nome" required>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="enviar" value="1">Gerar</button>
      <button type="submit" class="btn btn-primary" name="enviar" value="2">Pesquisar</button>
    </div>  
  </form>
  
  <form action="" method="post">
    <button type="submit" class="btn btn-primary" name="enviar" value="3">Ver todos</button>
  </form>
  <br>
  
  <div class="form-group">
    <?= (!empty($_SESSION['alerta']) ? $_SESSION['alerta'] : '');?>
  </div>
  <?php
    if (isset($query)){ ?>
      <div class="form-group">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Número NIS</th>
          </tr>
        </thead>
        <tbody>
            <?php
              if ($query != ''){
                $sql = $query;
              } else {
                $sql = "SELECT * FROM cadastro";
              }
              $result = $conn->query( $sql );
              if ($result){
                while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
                  echo '<tr>';
                  echo '<th scope="row">'.$linha['id'].'</th>';
                  echo '<td>'.$linha['nome'].'</td>';
                  echo '<td>'.$linha['nis'].'</td>';
                  echo '</tr>';
                }
              }
            ?>
        </tbody>
      </table>
    </div>
  <?php
  } 
  ?>
</div> <!-- container -->
<? include 'components/footer.php';