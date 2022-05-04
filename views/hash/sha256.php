<?php 
include_once(__DIR__.'/../layouts/header.php')
?>
<!-- Page Content  -->
<div id="content">
    <div class="container" style="margin:20px auto">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Enter Plain Text to Compute Hash</label>
                    <textarea class="form-control" id="input" rows="10" style="width: 100%;"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Enter the Secret Key</label>
                    <textarea class="form-control" id="key" rows="3" style="width: 100%;"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary hash">
                    Hash
                </button>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Output Hex</label>
                    <textarea class="form-control" id="output" rows="3" style="width: 100%;" disabled></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Output Base64</label>
                    <textarea class="form-control" id="output_base64" rows="3" style="width: 100%;" disabled></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include_once(__DIR__.'/../layouts/footer.php')
?>
<script src="/hmac-sha256.js"></script>
<script src="/enc-base64-min.js"></script>
<script>
    $(document).ready(function(){
        $('.hash').click(function(){
            let string = $('#input').val();
            let key = $('#key').val();
            var hash = CryptoJS.HmacSHA256(string, key);
            var hashInHex = CryptoJS.enc.Hex.stringify(hash);
            var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
            $('#output').html(hashInHex)
            $('#output_base64').html(hashInBase64)
        })
    });
</script>