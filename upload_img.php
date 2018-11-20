<?php
    include_once 'config/dbh.php';  
    require "header.php";
    if (!isset($_SESSION['username']))
        header('Location: index.php?login=not_logged_in');
?>
<main>
    <div class="wrapper_main">
        <section class="section_default">
            <h1>Upload An Image</h1>
            <script>
            window.onload = function()
            {
                document.querySelector("#canvas-hold").style.display = "none";
            }
            </script>

            <div id="div-img-src">
                <div id="div-video">
                    <p>Image Source</p >
                    <video id="video">Stream not availlable...</video><br/>
                    <button id="photo-button">Take Photo</button><br/>
                </div>

                <div id="div-preexisting-photo">
                        <p>Choose Pre-existing Image</p >
                        <input id="input-img-preex" name="img-upload" type="file">
                </div>
            </div>

            <div id="photo-div">
                <p>Photo</p>
                <canvas id="canvas"></canvas>
                <button type="submit" id="id-submit-img" name="submit-img-button" value="">Save Image</button>
                <button type="submit" id="id-delete-img" name="delete-img-button" value="">Delete Image</button>

            <div id="stickers">
                <img draggable="true" id="joint" src ="stickers/joint.png" alt="joint" style="width:90px; height:90px;"/>
                <img id="shades_front" src ="stickers/shades_front.png" alt="shades" style="width:170px; height:170px;"/>             
                <img id="tl_text" src ="stickers/thug_life_text.png" alt="thug_life_text" style="width:200px; height:200px;"/>
            </div>    
            </div>
            <div>
            <?php
                $object = new Dbh;
                $pdo = $object->connect();
                $row = $object->selectUserImgsFromDbRecent($pdo, $_SESSION['username']);
                $img_type = "data:image/png; base64, ";

                $i = 0;
                while (isset($row[$i]))
                {
                    $src = $row[$i]['image'];
                    echo '<img style="width: 150px; height: auto;" alt="row" src="' . $img_type . $src .'"/>';
                    $i++;
                }
            ?>    
            </div>
            <canvas id="canvas-hold"></canvas>
        </section>
    </div>
</main>
<script src="js/main.js"></script>
<script src="js/edit_images.js"></script>
<?php
    require "footer.php"
?>