<?php
include_once './config.php';

$POST = new Posts;
if (!isset($_SESSION['user_id'])) {
    cheader("../index.php");
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>::Instanine::</title>
        <!-- Mobile Specific Metas -->

    </head>

    <body>
    <main>

        <?php include './inner_header.php'; ?>

        <!-- Main Container Starts -->        
        <section class="main_container">
            <section class="container">
                <div class="flw_title">
                    <h2>FAQ</h2>

                </div>
            </section>
        </section>

        <section>
            <div class="container">
                <div class="xpand_tbs">

                    <div id="accordion" class="panel-group">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">It has survived not only five centuries, but also the leap into electronic typesetting.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse in" id="collapseOne">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseTen" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseTen">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseEleven" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">It has survived not only five centuries, but also the leap into electronic typesetting.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseEleven">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseTwo">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">It has survived not only five centuries, but also the leap into electronic typesetting.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseThree">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseFive" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseFive">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseSix" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">It has survived not only five centuries, but also the leap into electronic typesetting.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseSix">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#collapseEight" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
                                </h4>
                            </div>
                            <div class="panel-collapse collapse" id="collapseEight">
                                <div class="panel-body">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
                                </div>
                            </div>
                        </div>





                    </div>


                </div>
            </div>
        </section>

        <!-- Main Container Ends -->
    </main>	
    <script src="OverTribe_files/bootstrap.js" type="text/javascript"></script>	     
</body>
</html>
