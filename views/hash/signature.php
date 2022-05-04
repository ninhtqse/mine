<?php 
include_once(__DIR__.'/../layouts/header.php')
?>
<!-- Page Content  -->
<div id="content">
    <div class="container" style="margin:20px auto">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Body</label>
                    <textarea class="form-control" id="body" rows="10" style="width: 100%;"></textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Path</label>
                        <textarea class="form-control" id="path" rows="3" style="width: 100%;"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Secret Key</label>
                        <textarea class="form-control" id="key" rows="3" style="width: 100%;"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <button class="btn btn-primary hash">
                    Hash
                </button>
            </div>
            <div class="col-lg-12" style="margin-top: 50px;">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Signature</label>
                    <textarea class="form-control" id="output" rows="3" style="width: 100%;" disabled></textarea>
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
            let body = JSON.stringify(JSON.parse($('#body').val()));
            let path = $('#path').val();
            let key  = $('#key').val();
            let connect = `${body}###${path}`;
            var hash = CryptoJS.HmacSHA256(connect, key);
            var hashInHex = CryptoJS.enc.Hex.stringify(hash);
            $('#output').html(hashInHex)
        })
    });
</script>