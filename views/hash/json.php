<?php 
include_once(__DIR__.'/../layouts/header.php')
?>
<!-- Page Content  -->
<div id="content">
    <div class="container" style="margin:10px auto">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Input</label>
                    <textarea class="form-control" id="input" rows="50" style="width: 100%;"></textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Output Format Trim</label>
                    <textarea class="form-control" id="output_trim" rows="10" style="width: 100%;" disabled></textarea>
                    <label for="exampleFormControlTextarea1">Output Format</label>
                    <pre id="output" style=
                        "color:green; font-size: 20px; font-weight: bold;">
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include_once(__DIR__.'/../layouts/footer.php')
?>
<script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
<script>
    $(document).ready(function(){
        $('#input').keyup(function(){
            let value = $('#input').val();
            var el_down = document.getElementById("output");
            el_down.innerHTML = JSON.stringify(JSON.parse(value), undefined, 4);
            $('#output_trim').val(JSON.stringify(JSON.parse(value)));
        });
    });
</script>