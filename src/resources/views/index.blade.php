<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Teste Uello</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="modal modal-sheet d-block" id="modalSheet">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title">Enviar Arquivo CSV</h5>
                    </div>
                    <div class="modal-body py-1">
                        <p>Para salvar um arquivo CSV no banco, basta selecioná-lo no seu diretório local e clicar no botão Salvar.</p>
                    </div>
                    <div class="modal-footer flex-column border-top-0">
                        <div name="divSpin" id="divSpin" style="display:none;" class="spin"></div>
                        <input type="file" name="pricesTableCSV" id="pricesTableCSV" accept=".csv" class="form-control" onchange="readFile()">
                        <button type="button" name="saveButton" id="saveButton" class="btn mt-4 font-weight-bold btn-danger" onclick="callProcess()">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">

    $(()=>{
        let arrayPricesTable = [];
    });

    function readFile() {
        const inputPricesTableCSV = document.getElementById("pricesTableCSV");
        const reader = new FileReader();

        reader.readAsText(inputPricesTableCSV.files[0]);

        reader.onload = function () {

            arrayPricesTable = reader.result.split(/\r?\n/).map(function(line) {
                if (line.length != 0) {
                    return line.split(';');
                }
            });

        }

    }

    function processArrayFromFile() {

        var results = [];

        return arrayPricesTable.reduce(function(p, chunk) {
            return p.then(function() {
                console.log(chunk);
                return $.ajax({
                    type: 'POST',
                    url: "{{ route('save') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'arrayToProcess': chunk
                    },
                    dataType: 'JSON',
                }).then(function(data) {
                    results.push(data);
                });
            });
        }, Promise.resolve()).then(function() {
            console.log(results);
            return results;
        });

    }

    function callProcess() {

        $("#pricesTableCSV").prop("disabled", true);
        $("#saveButton").prop("disabled", true);
        $("#divSpin").toggle();

        processArrayFromFile().then(function(results) {
            console.log('processou');
            console.log(results);
        }).catch(function(err) {
            console.log(err);
        });
    }

</script>