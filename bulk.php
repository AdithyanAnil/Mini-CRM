<?php
include 'aa.php';
?>
<div>




    <div class="h-[400px] w-[400px] border border-2 bg-white rounded-lg mx-60 text-center">
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <span  class="font-bold text-lg text-center">Select file to upload</span>

    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Upload File" name="submit">
    <p><span class="font-bold">Note:</span>Uploading should be CSV</p>
</form>
    </div>
</div>

