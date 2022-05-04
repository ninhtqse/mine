<?php 
include_once(__DIR__.'/../layouts/header.php')
?>
<!-- Page Content  -->
<div id="content">
    <div class="container" style="margin:200px auto">
        <div class="row">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Input</label>
                    <textarea class="form-control" id="input" rows="10" style="width: 100%;"></textarea>
                </div>
            </div>
            <div class="col-lg-2" style="margin:120px auto;padding-left: 35px;" >
                <button class="btn btn-primary encode">
                    ENCODE
                </button>
                <button class="btn btn-primary decode">
                    DECODE
                </button>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Output</label>
                    <textarea class="form-control" id="output" rows="10" style="width: 100%;"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include_once(__DIR__.'/../layouts/footer.php')
?>
<script>
    $(document).ready(function(){
        $('.encode').click(function(){
            let input = $('#input').val();
            $('#output').html(btoa(input))
        })
        $('.decode').click(function(){
            let input = $('#input').val();
            $('#output').html(atob(input))
        })
    });
</script>