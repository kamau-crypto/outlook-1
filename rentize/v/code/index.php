<?php
//
//This is the application's namespace
namespace chama;
//
include "config.php";
$config = new config();
?>
<html>

<head>
    <!-- 
        The tile of your project -->
    <title><?php echo $config->title; ?>.</title>
    <!-- 
        Styling the index page in terms of grids -->
    <link rel="stylesheet" href="index.css" />
    <!-- 
        Styling the theme panel-->
    <link id="theme_css" rel="stylesheet" href="../../../outlook/v/code/theme.css" />
    <!--
        Expose the main application to HTML pages-->
    <script type="module">
        //
        //Resolve the main (application) class. We are ow using a generic 
        //-- rather than a specific one like tracker -- to support creation
        //pf new applications simply by copying an existing one
        import main from "./main.js";
        //
        //Resolve any references to tha app class; this important for
        //adding event listeners to the home page
        import * as app from "../../../outlook/v/code/app.js";
        //
        //Make the general app visible beyond this module. NB: the class 
        //app is in the app namespace. Get
        window.app = app.app;
        //
        //Resolve the crud namespace reference required by the 
        //crud page.
        import * as crud from "../../../outlook/v/code/crud.js"
        //
        //Make the available in the html page
        window.crud = crud;

        //Start the application after fully loading the current 
        //window.
        window.onload = async () => {
            //
            //Use the php configuration file to create the main application
            window.Main = new main(<?php echo json_encode($config); ?>);
            //
            //Complete the creatio of 'main' by evoking the asynchronous 
            //methods (which are not callable from the constructor)
            await window.Main.initialize();
        };
    </script>

    <!-- Marker for styling columns -->
    <style id="columns"></style>

</head>

<body>
    <div class="header">
        <!--
          Company logo -->
        <div id="logo">
            <div>
                <img src="../images/<?php echo $config->logo; ?>" height="50" width="50" />
            </div>
        </div>
        <div id="company">
            <?php
            echo ucfirst($config->id) . ":$config->trade</br>"
                . $config->tagline;
            ?>
        </div>
        <div class="selection">
            <select id="selection" onchange="app.current.change_subject(this)">
            </select>
        </div>
    </div>
    <div id="services">Services
    </div>
    <div id="content">
        Content
        <table>
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="welcome">
        Please <button onclick="app.current.login()">login</button> to access
        various services
    </div>
    <div id="event">events</div>
    <div id="message">message
    </div>
    <div class="footer">
        <div id="developer">
            <img class="img_dev" src="../images/mutall/<?php echo $config->image; ?>" alt="developer's image">
        </div>
        <div id="signature">
            Developed by:<?php echo $config->developer; ?>
        </div>
        <div id="about">
            Mutall Data Company
        </div>
    </div>
</body>

</html>