<!DOCTYPE html>
<html>
<head>
    <lang="en-US">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" name="Vlad" content="OBIS">
    <link rel="stylesheet" href="PaginaMea.css">
    <title>OBISbarbati</title>
    </head>


<body>
<div class="bara_ecran_mare">
    <a href="#home" class="homes">Home</a>
    <a href="#language" class="languages">Language</a>
    <a href="#login" class="logins">Log In</a>
    <a href="#signup" class="signups">Sign up</a>
</div>

<div class="bara_ecran_mic">
    <a href="#language" class="languages">Language</a>
    <a href="#login" class="logins">Log In</a>
    <a href="#signup" class="signups">Sign up</a>
    <a href="#home" class="homes">Home</a>
</div>

<main class="continut" id="home">
    <h1 class="primul_paragraf">
        What is male obesity prevalence?
    </h1>
    
    <!--<figure>
      <img src="bmw.jpg" alt="BMW albastru" title="Un BMW albastru">
        <figcaption>Un alt bmw albastru</figcaption>
    </figure>
      <img src="bmw.jpg" alt="BMW albastru" title="Un BMW albastru" id="login">-->
    <pre>
    <?php
        foreach($datele as $date)
        {
            echo $date[0];
            echo "<br>";
        }
    ?>
    </pre>
</main>

<a href="mailto:nowhere@mozilla.org">Send email to nowhere</a>
<footer>
    <p>©Copyright 2020 by Vlad. All rights reversed.</p>
</footer>
<button class="un_buton">
    <i class="face_el_ceva"></i> Apasa-ma
</button>
</body>
</html>
