<?php 
include_once(__DIR__.'/../layouts/header.php')
?>
<!-- Page Content  -->
<div id="content">
    <div class="container" style="margin:200px auto">
        <div class="row">
            <div class="col-lg-2" style="margin:120px auto;padding-left: 100px;" >
                <button class="btn btn-primary encode">
                    GEN
                </button>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Output</label>
                    <textarea class="form-control" id="output" rows="10" style="width: 100%;" disabled></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include_once(__DIR__.'/../layouts/footer.php')
?>
<script>
    function uuidv4() {
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }
    $(document).ready(function(){
        $('.encode').click(function(){
            let input = $('#input').val();
            $('#output').html(uuidv4(input))
        })
    });
</script>