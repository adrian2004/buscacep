<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Buscador de CEP</title>

</head>

<body>

  <h1>Buscador de CEP</h1>
  <div class="input-group mb-3" style="width: 400px;">
    <input type="text" id="txtCep" class="form-control" placeholder="Digite o CEP" aria-label="Recipient's username" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="button" id="buscarCep">Pesquisar</button>
  </div>
<!--
  <br>
  <hr>

  <div class="">
    <label class="teste">Rua:</label>
    <p id="retornoRua"></p>

    <hr>

    <label class="teste">Bairro:</label>
    <p id="retornoBairro"></p>

    <hr>

    <label class="teste">Cidade:</label>
    <p id="retornoCidade"></p>

    <hr>

    <label class="teste">UF:</label>
    <p id="retornoUF"></p>

    <hr>

    <label class="teste">Cep:</label>
    <p id="retornoCep"></p>
  </div>
-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/jquery/dist/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/jquery/dist/jquery.min.js'); ?>"></script>

  <div id="dadosModal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Endereço encontrado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li id="retornoRua" class="list-group-item"></li>
          <li id="retornoBairro" class="list-group-item"></li>
          <li id="retornoCidade" class="list-group-item"></li>
          <li id="retornoUF" class="list-group-item"></li>
          <li id="retornoCep" class="list-group-item"></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button id="fecharModal" type="button" class="btn btn-primary">Fechar</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>

<script type="text/javascript">

  var baseUrl = "<?= base_url('cepcontroller'); ?>";

  $(document).ready(function() {

    $('#buscarCep').click(function() {

      const cep = $('#txtCep').val();
      $('#buscarCep').attr('disabled', true).text('buscando...');

      $.post(baseUrl + '/getCep', {
        cep
      }, function(data) {

        $('#buscarCep').attr('disabled', false).text('Pesquisar');

        if (data.status == 400) {

          alert(`Erro ao buscar dados: ${data.response}`);
          return;
        }

        $('#dadosModal').modal('show');

        $('#retornoRua').html("Rua:".bold() + " " + data.response.logradouro);
        $('#retornoBairro').html("Bairro:".bold() + " " + data.response.bairro);
        $('#retornoCidade').html("Cidade:".bold() + " " + data.response.localidade);
        $('#retornoUF').html("UF:".bold() + " " + data.response.uf);
        $('#retornoCep').html("Cep:".bold() + " " + data.response.cep);

      }, 'json');

    });

    $('#fecharModal').click(function() {
      $('#dadosModal').modal('hide');
    });
  });

</script>